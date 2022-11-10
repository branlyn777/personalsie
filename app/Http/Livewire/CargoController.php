<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Cargo;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use App\Models\AreaTrabajo;
use App\Models\FunctionCargo;

use Illuminate\Support\Facades\DB;

class CargoController extends Component
{
    use WithFileUploads;
    use WithPagination;

    // Datos de cargo
    public $name, $areaid, $estado, $selected_id;
    public $pageTitle, $componentName, $search;
    private $pagination = 10;

    // Datos de  funciones
    public $funcionDeCargo, $selected_Fun_id;
    public $pageTitleFuncion, $componentNameFunciones;

    public function mount(){
        $this -> pageTitle = 'Listado';
        $this -> componentName = 'Cargos de Trabajo';

        $this->areaid = 'Elegir';
        $this->estado = 'Elegir';
        $this->idEmpleado = 0;

        // datos de funcion
        $this->pageTitleFuncion = 'Nueva Funcion';
        $this->componentNameFunciones = 'Lista de Funciones';
    }

    public function paginationView()
    {
        return 'vendor.livewire.bootstrap';
    }

    public function render()
    {
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
                'cargos' => $data,  // se envia cargos
                'areas' => AreaTrabajo::orderBy('nameArea', 'asc')->get(),
            ])
        ->extends('layouts.theme.app')
        ->section('content');
    }

    // verificar 
    public function verificar($idcargo)
    {
        $consulta = Cargo::join('employees as e', 'e.cargo_id', 'cargos.id')
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

    // Abre el modal de Nueva Funcion
    public function NuevoFuncion()
    {
        //$this->resetUI();
        $this->emit('modal-hide', 'show modal!');
        $this->emit('show-modal-Nfuncion', 'show modal!');
    }

    // crear y guardar
    public function nuevaFuncionC(){
        $rules = [
            'funcionDeCargo' => 'required',
        ];
        $messages =  [
            'funcionDeCargo.required' => 'Este espacio es requerida',
        ];

        $this->validate($rules, $messages);

        $functioncargo = FunctionCargo::create([
            'funcionDeCargo' => $this->funcionDeCargo,
        ]);

        $this->resetUI();
        $this->emit('fun-added', 'Funcion Registrado');
        $this->emit('modal-hide-Nfuncion', 'show modal!');
    }

    // vista de modal funciones
    public function NuevaVFuncion()
    {
        $this->emit('modal-hide', 'show modal!');
        $this->emit('show-modal-Vfuncion', 'show modal!');
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

    // actualizar cargo
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

    public function resetUI(){
        $this->name='';
        $this->areaid = 'Elegir';
        $this->estado = 'Elegir';
        $this->search='';
        $this->selected_id=0;

        // reset funciones
        $this->funcionDeCargo = '';
    }

    protected $listeners = [
        'deleteRow' => 'Destroy'
    ];

    // eliminar cargo
    public function Destroy($id)
    {
        $cargo = Cargo::find($id);
        $cargo->delete();
        $this->resetUI();
        $this->emit('cargo-deleted','Cargo Eliminada');
    }
}
