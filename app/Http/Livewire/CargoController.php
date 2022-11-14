<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Cargo;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use App\Models\AreaTrabajo;
use App\Models\Funciones;

use Illuminate\Support\Facades\DB;

class CargoController extends Component
{
    use WithFileUploads;
    use WithPagination;

    // Datos de cargo
    public $idcargo, $name, $areaid, $estado, $selected_id;
    public $pageTitle, $componentName, $search;
    private $pagination = 10;

    // Datos de Funcion
    public $idFuncion, $nameFuncion1, $cargoid, $selected_fun_id , $detalle; //,
    public $pageTitleF, $componentNameF, $pageTitleMod;

    public function mount(){
        $this -> pageTitle = 'Listado';
        $this -> componentName = 'Cargos de Trabajo';

        $this->areaid = 'Elegir';
        $this->estado = 'Elegir';
        $this->idcargo = 0;

        // Funciones
        $this -> pageTitleF = 'Lista de Funciones';
        $this -> componentNameF = 'Nueva Funcion';
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
        if(strlen($this->search) > 0)
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
            'areas' => AreaTrabajo::orderBy('nameArea', 'asc')->get(),
            //'cargosx' => Cargo::orderBy('name', 'asc')->get(),
            ])
        ->extends('layouts.theme.app')
        ->section('content');
    }

    // verificar dato para eliminar
    public function verificar($idcargo)
    {
        $consulta = Cargo::join('funciones as fun', 'fun.cargo_id', 'cargos.id')
        ->select('cargos.*')
        ->where('cargos.id', $idcargo)
        ->get();

        if($consulta->count() > 0)
        {
            return "no";
        }
        else
        {
            return "si";
        }
    }

    // Registrar Nueva Funcion
    public function NuevaFuncion($idcargo)
    {
        //$this->emit('fun-added', 'Funcion Registrada');
        $detalle = Cargo::join('area_trabajos as at', 'at.id', 'cargos.area_id')
        ->select('cargos.id as idcargo', 'cargos.name')
        ->where('cargos.id', $idcargo) // selecciona el Cargo
        ->get()
        ->first();

        $this->name = $detalle->name;

        //dd($this->idcargo = $detalle->idcargo);
        //$this->emit('modal-hide', 'show modal!');
        $this->emit('show-modal-NFuncion', 'show modal!');

        $funcion = new FuncionesController;
        $funcion->selected_fun_id=$this->selected_fun_id;
        $funcion->nameFuncion= $this->nameFuncion1;
        $funcion->cargoid = $this->idcargo = $detalle->idcargo;
        $funcion->Store();
        $this->resetFUN();

        $this->emit('fun-added', 'Funcion Registrada');
    }

    public function resetFUN()
    {
        $this->nameFuncion1= '';
        //$this->cargoid = 'Elegir';
        $this->resetValidation(); // resetValidation para quitar los smg Rojos
    }

    // Ver Funciones de cargo
    public function VistaFuncion($idcargo)
    {
        $this-> detalle = Cargo::join('funciones as fun', 'fun.cargo_id', 'cargos.id')
        ->select('cargos.id as idcargo', 'cargos.name', 'fun.cargo_id', 'fun.nameFuncion')
        ->where('cargos.id', $idcargo)    // selecciona al empleado
        ->get();
        //->first();

        $this->emit('show-modal-VFuncion', 'show modal!');
    }

    // Ver Datos a Editar de la Funcion
    public function EditarF($idcargo)
    {
        $this->selected_id = $idcargo;

        $this->emit('modal-hide-VFuncion', 'show modal!');
        //$this->emit('show-modal-EditFuncion', 'show modal!');
        $this->emit('show-modal-NFuncion', 'show modal!');
        //dd('Prueba de ediccion');
        $detalle = Cargo::join('funciones as fun', 'fun.cargo_id', 'cargos.id')
        ->select('cargos.id as idcargo', 'cargos.name', 'fun.cargo_id', 'fun.nameFuncion')
        ->where('cargos.id', $idcargo)    // selecciona al empleado
        ->get()
        ->first();

        //dd($this->idcargo = $detalle->idcargo);
        $this->name = $detalle->name;
        //$this->idcargo = $detalle->idcargo;
        //$this->nameFuncion = $detalle->nameFuncion;

        // $funcion = new FuncionesController;
        // $funcion->selected_fun_id=$this->selected_fun_id;
        // $funcion->nameFuncion= $this->nameFuncion;
        // $funcion->cargoid = $this->idcargo = $detalle->idcargo;
        // $funcion->Edit($idFuncion);
        //$this->resetFUN();

    }

    // Actualizar Funciones seleccionada
    public function ActualizarFuncion()
    {
        $this->emit('modal-hide-EditFuncion', 'show modal!');
        $this->emit('show-modal-VFuncion', 'show modal!');

        $funcion = new FuncionesController;
        $funcion->selected_fun_id=$this->selected_fun_id;
        $funcion->nameFuncion= $this->nameFuncion;
        $funcion->cargoid = $this->cargoid;
        $funcion->Update();
        // // //$this->resetFUN();
        $this->emit('fun-updated', 'Funcion Actualizada');
    }

    public function EliminarF()
    {
        dd('Prueba de Eliminacion');
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
            'name'=>$this->name,
            'area_id' => $this->areaid,
            'estado'=>'Disponible'
        ]);

        $this->resetUI();
        $this->emit('cargo-added', 'Cargo Registrado');
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
            'name' => $this->name,
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
