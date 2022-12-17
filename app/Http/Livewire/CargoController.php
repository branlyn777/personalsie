<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Cargo;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use App\Models\Employee;
use App\Models\AreaTrabajo;
use App\Models\Funciones;
use FontLib\Table\Type\name;
use Illuminate\Support\Facades\DB;

class CargoController extends Component
{
    use WithFileUploads;
    use WithPagination;

    // Datos de cargo
    public $idcargo, $name, $areaid, $estado, $selected_id;
    public $pageTitle, $componentName, $search;
    private $pagination = 10;
    public $selected;

    // Datos de Funcion
    public $idFuncion, $nameFuncion1, $descripcion, $cargoid, $selected_fun_id , $detalle; //,
    public $pageTitleF, $componentNameF, $pageTitleMod;
    public $funame, $idFunselect;

    public $idCargoF;

    public function mount(){
        $this -> pageTitle = 'Listado';
        $this -> componentName = 'Cargos de Trabajo';

        $this->areaid = 'Elegir';
        $this->estado = 'Elegir';
        $this->idcargo = 0;
        $this->selected = 'Todos';

        // Funciones
        $this -> pageTitleF = 'Lista de Funciones';
        $this -> componentNameF = 'Crear Nueva Funcion';
        $this-> pageTitleMod = 'Editar Funcion';
        //$this->cargoid = 'Elegir';
    }

    public function paginationView()
    {
        return 'vendor.livewire.bootstrap';
    }

    public function render()
    {
        //dd($this-> detalle);
        //if(strlen($this->search) > 0)
        if ($this->selected == 'Todos')
        {
            $data = Cargo::join('area_trabajos as at', 'at.id', 'cargos.area_id')
            ->select('cargos.id as idcargo','cargos.name as name','at.nameArea as area','cargos.estado as estado',
                DB::raw('0 as verificar'))
            ->orderBy('at.id','desc')
            ->where('cargos.name', 'like', '%' . $this->search . '%')
            ->paginate($this->pagination);

            foreach ($data as $os)
            {
                //Obtener los servicios de la orden de servicio
                $os->verificar = $this->verificar($os->idcargo);
            }
        }
        else
        {
            $data = Cargo::join('area_trabajos as at', 'at.id', 'cargos.area_id')
            ->select('cargos.id as idcargo','cargos.name as name','at.nameArea as area','cargos.estado as estado',
                DB::raw('0 as verificar'))
            ->where('cargos.estado',$this->selected)
            ->where(function($querys){
                $querys->where('cargos.name', 'like', '%' . $this->search . '%');
            })
            ->orderBy('at.id','desc')
            ->paginate($this->pagination);

            foreach ($data as $os)
            {
                //Obtener los servicios de la orden de servicio idcategoria
                $os->verificar = $this->verificar($os->idcargo);
            }
        }

        return view('livewire.cargo.component', [
            'cargos' => $data, // se envia cargos
            'areas' => AreaTrabajo::where('estadoA', 'Activo')->orderBy('nameArea', 'asc')->get(),
            ])
        ->extends('layouts.theme.app')
        ->section('content');
    }

    // verificar dato para eliminar
    public function verificar($idcargo)
    {
        $consulta = Cargo::join('employees as emp', 'emp.cargo_id', 'cargos.id')
        ->select('cargos.*')
        ->where('cargos.id', $idcargo)
        ->get();

        $consulta = Cargo::join('funciones as fun', 'fun.cargo_id', 'cargos.id')
        ->select('cargos.*')
        ->where('cargos.id', $idcargo)
        ->get();
        
        if($consulta->count() > 0)
        {
            return "1";
        }
        else
        {
            return "0";
        }
    }

    // Registrar nuevo cargo
    public function Store(){
        $rules = [
            'name' => 'required|unique:cargos|min:5',
            'areaid' => 'required|not_in:Elegir',
            //'estado' => 'required|not_in:Elegir',
        ];
        $messages =  [
            'name.required' => 'Nombre de cargo es requerida',
            'name.unique' => 'ya existe el nombre del cargo',
            'name.min' => 'el nombre del cargo debe tener al menos 5 caracteres',

            'areaid.required' => 'Elija un Area',
            'areaid.not_in' => 'Elije un nombre de Area diferente de elegir',

            //'estado.required' => 'seleccione estado de cargo',
            //'estado.not_in' => 'selecciona estado de cargo',
        ];

        $this->validate($rules, $messages);

        $cargo = Cargo::create([
            'name'=> strtoupper($this->name),
            'area_id' => $this->areaid,
            'estado'=> 'Activo'
        ]);

        $this->idcargo = $cargo->id;

        $this->resetUI();
        $this->emit('cargo-added', 'Cargo Registrado');
    }

    // Ver Funciones de cargo
    public function VistaFuncion($idcargo)
    {
        //dd($idcargo);
        $this->emit('show-modal-VFuncion', 'show modal!');
        
        $this->detalle = Cargo::join('funciones as fun', 'fun.cargo_id', 'cargos.id')
        ->select('fun.id as idfuncion', 'fun.nameFuncion' ,'fun.descripcion', 'cargos.name', 'cargos.id')
        ->where('cargos.id', $idcargo)    // selecciona al empleado
        ->get();

        $this->idCargoF = $idcargo;
    }

    // Abrir modal de nueva funcion
    public function AbrirNuevaFuncion()
    {
        $this->resetUI();
        $this->emit('modal-hide-VFuncion', 'show modal!');
        $this->emit('show-modal-NFuncion', 'show modal!');

        $detalle = Cargo::select('cargos.*')
        ->where('cargos.id', $this-> idCargoF)
        ->get()
        ->first();

        $this->name = $detalle->name;
    }

    // Registrar Nueva Funcion
    public function NuevaFuncion()
    {
        $funcion = Funciones::create([
            'nameFuncion'=> strtoupper($this->nameFuncion1),
            'descripcion' => strtoupper($this->descripcion),
            'cargo_id'=> $this-> idCargoF,
        ]);

        $this->emit('fun-added', 'Funcion Registrada');
        $this->emit('modal-hide-NFuncion', 'show modal!');
    }

    // Ver Datos a Editar de la Funcion
    public function EditarF($idfuncion)
    {
        $this->idFunselect = $idfuncion;
        $detalle = Funciones::find($idfuncion);

        //dd($detalle);
        $this->name = $detalle->cargo->name;
        $this->funame = $detalle->nameFuncion;
        $this->descripcion = $detalle->descripcion;
        
        //$this->resetFUN();
        $this->emit('modal-hide-VFuncion', 'show modal!');
        $this->emit('show-modal-EditFuncion', 'show modal!');
    }

    // Actualizar Funciones seleccionada
    public function ActualizarFuncion()
    {
        $funcion = new FuncionesController;
        $funcion->selected_id=$this->idFunselect;
        $funcion->nameFuncion= strtoupper($this->funame);
        $funcion->descripcion= strtoupper($this->descripcion);
        $funcion->Update();
        
        $this->emit('fun-updated', 'Funcion Actualizada');
        
        $this->emit('show-modal-EditFuncion', 'show modal!');
        $this->emit('modal-hide-EditFuncion', 'show modal!');
    }

    public function EliminarF($idfuncion)
    {
        //dd($idfuncion);
        Funciones::find($idfuncion)->delete();
        $this->emit('modal-hide-VFuncion','Funcion Eliminada');
    }

    public function resetFUN()
    {
        $this->nameFuncion1= '';
        $this->descripcion = '';
        $this->resetValidation(); // resetValidation para quitar los smg Rojos
    }

    // editar cargo
    public function Edit($id){
        $record = Cargo::find($id, ['id', 'name', 'area_id', 'estado']);
        $this->name = $record->name;
        $this->areaid = $record->area_id;
        $this->estado = $record->estado;
        $this->selected_id = $record->id;

        $this->emit('show-modal', 'show modal!');
    }

    // actualizar datos de cargo
    public function Update(){
        $rules = [
            'name' => "required|min:5|unique:cargos,name,{$this->selected_id}",
            'areaid' => 'required|not_in:Elegir',
            //'nrovacantes.required' => 'Nombre del cargo es requerida',
            //'estado' => 'required|not_in:Elegir',
        ];

        $messages = [
            'name.required' => 'Nombre de cargo es requerida',
            'name.unique' => 'ya existe el nombre del cargo',
            'name.min' => 'el nombre del cargo debe tener al menos 5 caracteres',

            'areaid.required' => 'Elija un Area',
            'areaid.not_in' => 'Elije un nombre de Area diferente de elegir',

            //'estado.required' => 'seleccione estado de cargo',
            //'estado.not_in' => 'selecciona estado de cargo',
        ];
        $this->validate($rules,$messages);

        $cargo = Cargo::find($this->selected_id);
        $cargo -> update([
            'name' => strtoupper($this->name),
            'area_id' => $this->areaid,
            'estado'=>$this->estado
        ]);

        $this->resetUI();
        $this->emit('cargo-updated','Cargo Actualizada');
    }

    // Limpiar Formulario de Registro
    public function resetUI(){
        $this->name='';
        $this->areaid = 'Elegir';
        $this->estado = 'Elegir';
        $this->search='';
        $this->selected_id=0;
    }

    // Eliminar datos de cargo
    protected $listeners = [
        'deleteRow' => 'Destroy'
    ];

    public function Destroy($id)
    {
        $cargo = Cargo::find($id);
        $cargo->delete();
        $this->resetUI();
        $this->emit('cargo-deleted','Cargo Eliminada');
    }
}
