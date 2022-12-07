<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Funciones;
use App\Models\Cargo;
use Livewire\WithPagination;

use Illuminate\Support\Facades\DB;
use phpDocumentor\Reflection\Types\This;

class FuncionesController extends Component
{
    use WithPagination;

    public $nameFuncion, $descripcion, $selected_id; //, $cargoid
    public $pageTitle, $componentName, $search;
    private $pagination = 5;


    public function mount(){
        $this -> pageTitle = 'Lista';
        $this -> componentName = 'Funciones';

        $this->cargoid = 'Elegir';
    }

    public function paginationView()
    {
        return 'vendor.livewire.bootstrap';
    }

    public function render()
    {
            if(strlen($this->search) > 0)
            {
                $data = Funciones::join('cargos as cs', 'cs.id', 'funciones.cargo_id')
                ->select('funciones.*', 'cs.name as cargo', 'funciones.id as idFuncion',
                    DB::raw('0 as verificar'))
                ->where('funciones.nameFuncion', 'like', '%' . $this->search . '%')    
                ->orderBy('cs.name', 'asc')
                ->paginate($this->pagination);

                foreach ($data as $os)
                {
                    //Obtener los servicios de la orden de servicio
                    $os->verificar = $this->verificar($os->idFuncion);
                }
            }else{
                $data = Funciones::join('cargos as cs', 'cs.id', 'funciones.cargo_id')
                ->select(
                    'funciones.*',
                    'cs.name as cargo',
                    'funciones.id as idFuncion',
                    DB::raw('0 as verificar')
                )
                ->orderBy('cs.name', 'asc')
                ->paginate($this->pagination);

                foreach ($data as $os) {
                    //Obtener los servicios de la orden de servicio
                    $os->verificar = $this->verificar($os->idFuncion);
                }
            }

            return view('livewire.funcionCargo.component',[
                'funciones' => $data,
                'cargos' => Cargo::orderBy('name', 'asc')->get(),
            ])
            ->extends('layouts.theme.app')
            ->section('content');
    }

    // verificar 
    public function verificar($idFuncion)
    {
        $consulta = Funciones::where('funciones.id', $idFuncion);
        
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
            'nameFuncion' => 'required',
            'cargoid' => 'required|not_in:Elegir',
        ];
        $messages =  [
            'nameFuncion.required' => 'Este espacio es requerido',
            'cargoid.required' => 'Elija un Cargo',
            'cargoid.not_in' => 'Elije un nombre de Cargo diferente de elegir',
        ];

        $this->validate($rules, $messages);

        $funciones = Funciones::create([
            'nameFuncion'=> strtoupper($this->nameFuncion),
            'descripcion' => strtoupper($this->descripcion),
            'cargo_id' => $this->cargoid// = Session::get('cargo_id'),
        ]);

        $this->resetUI();
        $this->emit('fun-added', 'Funcion Registrado');
        //Session::put('funcion_id',$idcargo);
        return redirect('cargos');
    }

    // editar datos
    public function Edit(Funciones $funciones){
        $this->selected_id = $funciones->id;
        $this->nameFuncion = $funciones->nameFuncion;
        $this->descripcion = $funciones->descripcion;
        //$this->cargoid = $funciones->cargo_id;

        $this->emit('show-modal', 'show modal!');
    }

    // Actualizar datos
    public function Update(){
        $rules = [
            'nameFuncion' => 'required',
            //'cargoid' => 'required|not_in:Elegir',
        ];
        $messages =  [
            'nameFuncion.required' => 'Este espacio es requerida',
            //'cargoid.required' => 'Elija un Cargo',
            //'cargoid.not_in' => 'Elije un nombre de Cargo diferente de elegir',
        ];
        $this->validate($rules,$messages);

        $funciones = Funciones::find($this->selected_id);
        $funciones -> update([
            'nameFuncion'=>$this->nameFuncion,
            'descripcion'=>$this->descripcion
            //'cargo_id' => $this->cargoid,
        ]);

        $this->resetUI();
        $this->emit('fun-updated','Funcion Actualizada');
    }

    // vaciar formulario
    public function resetUI(){
        $this->cargoid = 'Elegir';
        $this->nameFuncion ='';
        $this->descripcion = '';
        $this->search ='';
        $this->selected_id =0;
        $this->resetValidation(); // resetValidation para quitar los smg Rojos
    }

     // eliminar
    protected $listeners = [
        'deleteRow' => 'Destroy'
    ];

    public function Destroy(Funciones $funciones){
        //dd($funciones);
        $funciones->delete();
        $this->resetUI();
        $this->emit('fun-deleted','Funcion Eliminada');
    }
}
