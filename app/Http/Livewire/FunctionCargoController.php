<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\FunctionCargo;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

use Illuminate\Support\Facades\DB;

class FunctionCargoController extends Component
{
    use WithFileUploads;
    use WithPagination;

    public $funcionDeCargo, $selected_id;
    public $pageTitle, $componentName, $search;
    private $pagination = 5;

    public function mount(){
        $this -> pageTitle = 'Lista';
        $this -> componentName = 'Lista de Funciones';
    }

    public function paginationView()
    {
        return 'vendor.livewire.bootstrap';
    }

    public function render()
    {
        if(strlen($this->search) > 0)
        {
            $data = FunctionCargo::select('function_cargos.*', 'function_cargos.id as idFuncion',
                DB::raw('0 as verificar'))
            ->where('function_cargos.funcionDeCargo', 'like', '%' . $this->search . '%')         
            ->orderBy('function_cargos.funcionDeCargo', 'asc')
            ->paginate($this->pagination);

            foreach ($data as $os)
            {
                //Obtener los servicios de la orden de servicio
                $os->verificar = $this->verificar($os->idFuncion);
            }
        }
        else
        
            $data = FunctionCargo::select('function_cargos.*', 'function_cargos.id as idFuncion',
                DB::raw('0 as verificar'))
            ->orderBy('function_cargos.funcionDeCargo', 'asc')
            ->paginate($this->pagination);

            foreach ($data as $os)
            {
                //Obtener los servicios de la orden de servicio
                $os->verificar = $this->verificar($os->idFuncion);
            }
        

        return view('livewire.cargo.vistaFunciones', [
                'funciones' => $data
            ])
        ->extends('layouts.theme.app')
        ->section('content');
    }

    // verificar 
    public function verificar($idFuncion)
    {
        $consulta = FunctionCargo::where('function_cargos.id', $idFuncion);
        
        if($consulta->count() > 0)
        {
            return "si";
        }
        else
        {
            return "no";
        }
    }

    // crear y guardar
    public function Store(){
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
    }

    // editar datos
    public function Edit(FunctionCargo $functioncargo){
        $this->selected_id = $functioncargo->id;
        $this->funcionDeCargo = $functioncargo->funcionDeCargo;

        $this->emit('show-modal', 'show modal!');
    }

    // Actualizar datos
    public function Update(){
        $rules = [
            'funcionDeCargo' => 'required',
        ];
        $messages =  [
            'funcionDeCargo.required' => 'Este espacio es requerida',
        ];
        $this->validate($rules,$messages);

        $functioncargo = FunctionCargo::find($this->selected_id);
        $functioncargo -> update([
            'funcionDeCargo' => $this->funcionDeCargo,
        ]);

        $this->resetUI();
        $this->emit('fun-updated','Funcion Actualizada');
    }

    // vaciar formulario
    public function resetUI(){
        $this->funcionDeCargo = '';
        $this->search='';
        $this->selected_id=0;
        $this->resetValidation(); // resetValidation para quitar los smg Rojos
    }

    protected $listeners = [
        'deleteRow' => 'Destroy'
    ];

    // eliminar
    public function Destroy(FunctionCargo $functioncargo){
        $functioncargo->delete();
        $this->resetUI();
        $this->emit('fun-deleted','Funcion Eliminada');
    }
}
