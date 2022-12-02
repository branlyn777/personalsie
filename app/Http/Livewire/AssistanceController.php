<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Assistance;
use App\Models\Employee;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as Image;
//use Intervention\Image\Facades\Image;

use Illuminate\Support\Facades\DB;

class AssistanceController extends Component
{
    use WithFileUploads;
    use WithPagination;

    public $empleadoid, $fecha, $motivo, $comprobante, $selected_id;
    public $pageTitle, $componentName, $search;
    private $pagination = 5;
    //public $selected;

    public function mount(){
        $this -> pageTitle = 'Listado';
        $this -> componentName = 'Permisos ó licencias';
        // $this->estadoA = 'Elegir';
        // $this->selected = 'Todos';

        // seleccionar empleado
        $this->empleadoid = 'Elegir';
    }

    public function paginationView()
    {
        return 'vendor.livewire.bootstrap';
    }

    public function render()
    {
        //if($this->selected == 'Todos')
        if(strlen($this->search) > 0)
        {
            $data = Assistance::join('employees as at', 'at.id', 'assistances.empleado_id') // se uno amabas tablas
            ->select('assistances.*','at.name as empleado', 'assistances.id as idAsistencia', DB::raw('0 as verificar'))
            ->where('at.name', 'like', '%' . $this->search . '%')   
            ->orderBy('assistances.fecha', 'asc')
            ->paginate($this->pagination);

            foreach ($data as $os)
            {
                //Obtener los servicios de la orden de servicio
                $os->verificar = $this->verificar($os->idAsistencia);
            }
        }
        else{
            $data = Assistance::join('employees as at', 'at.id', 'assistances.empleado_id')
            ->select('assistances.*','at.name as empleado', 'assistances.id as idAsistencia', DB::raw('0 as verificar'))
            // ->where('assistances.estadoA',$this->selected)
            // ->where(function($querys){
            //     $querys->where('at.name', 'like', '%' . $this->search . '%');
            // })
            ->orderBy('assistances.fecha', 'asc')
            ->paginate($this->pagination);

            foreach ($data as $os)
            {
                //Obtener los servicios de la orden de servicio
                $os->verificar = $this->verificar($os->idAsistencia);
            }
        }

        return view('livewire.assistances.component', [
            'asistencias' => $data,        // se envia asistencias
            'empleados' => Employee::where('estado', 'Activo')->orderBy('name', 'asc')->get()
            ])
        ->extends('layouts.theme.app')
        ->section('content');
    }

    // verificar 
    public function verificar($idAsistencia)
    {
        $consulta = Assistance::where('assistances.id', $idAsistencia);
        
        if($consulta->count() > 0)
        {
            return "si";
        }
        else
        {
            return "no";
        }
    }

    // ver comprobante
    public function verImagen($idAsistencia)
    {
        $detalle = Assistance::join('employees as at', 'at.id', 'assistances.empleado_id')
        ->select('assistances.id as idAsistencia',
            'assistances.comprobante'
            )
            //'assistances.empleado_id as idEmpleado'
            //'at.empleado_id as idempleado')
        ->where('assistances.id', $idAsistencia)    // selecciona
        ->get()
        ->first();

        //dd($this->name = $detalle->empleado);
        //$this->idEmpleado = $detalle->idEmpleado;
        $this->comprobante = $detalle->comprobante;

        // $this-> detalle = Assistance::join('employees as at', 'at.id', 'assistances.empleado_id')
        // ->select('assistances.id as idAsistencia',
        //      'assistances.comprobante',
        //      'at.name')
        // ->where('assistances.id', $idAsistencia)    // selecciona
        // ->get();
    
        $this->emit('show-modal-img', 'open modal');
    }

    // crear y guardar
    public function Store(){
        $rules = [
            'fecha' => 'required',
            'empleadoid' => 'required|not_in:Elegir',
            //'estadoA' => 'required|not_in:Elegir',
            'comprobante' => 'nullable|mimes:jpeg,png,jpg,gif,svg'
        ];
        $messages =  [
            'fecha.required' => 'La fecha es requerida',
            'empleadoid.not_in' => 'Elije un nombre de empleado diferente de elegir',
            // 'estadoA.required' => 'seleccione estado de asistencia',
            // 'estadoA.not_in' => 'Selecione tipo de permiso diferente a elegir',
            'comprobante.mimes' => 'Solo se permite imagen'
        ];

        $this->validate($rules, $messages);

        $assistance = Assistance::create([
            'fecha'=>$this->fecha,
            'motivo'=>$this->motivo,
            'empleado_id' => $this->empleadoid,
            //'estadoA'=>$this->estadoA
        ]);

        //$customFileName;
        if($this->comprobante)
        {
            // guardar nueva imagen
            $customFileName = uniqid() . '_.' . $this->comprobante->extension();
            $path = $this->comprobante->storeAs('public/assistances', $customFileName);
            $assistance->comprobante = $customFileName;
            $assistance->save();

            //dd('hola');
            // proceso de compresion de imagen
            $fileName = collect(explode('/', $path))->last(); // obtener el nombre de la imagen asignado por laravel
            $imagex = Image::make(Storage::get($path)); // recuperar la imagen almacenada y crear una nueva instancia
            
            // reduccion de calidad y compresion de imagen
            $imagex->resize(1280, null, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });
            //dd($imagex);

            // por ultimo solo guardamos esta nueva instancia, reemplazando la imagen anterior.
            Storage::put($path, (string) $imagex->encode('jpg', 30));
        }

        $this->resetUI();
        $this->emit('asist-added', 'Ausencia Registrada');
    }

    // editar datos
    public function Edit(Assistance $assistance){
        $this->selected_id = $assistance->id;
        $this->fecha = $assistance->fecha;
        $this->motivo = $assistance->motivo;
        $this->empleadoid = $assistance->empleado_id;
        $this->comprobante = $assistance->null;
        //$this->estadoA = $assistance->estadoA;

        $this->emit('show-modal', 'show modal!');
    }

    // Actualizar datos
    public function Update(){
        $rules = [
            'fecha' => "required",
            'empleadoid' => 'required|not_in:Elegir',
            //'estado' => 'required|not_in:Elegir',
            'comprobante' => 'nullable|mimes:jpeg,png,jpg,gif,svg'
        ];
        $messages =  [
            'fecha.required' => 'La fecha es requerida',
            'empleadoid.not_in' => 'Elije un nombre de empleado diferente de elegir',
            //'estado.required' => 'seleccione estado de asistencia',
            //'estado.not_in' => 'selecciona estado de asistencia diferente a elegir',
            'comprobante.mimes' => 'Solo se permite imagen'
        ];
        $this->validate($rules,$messages);

        $assistance = Assistance::find($this->selected_id);
        $assistance -> update([
            'fecha'=>$this->fecha,
            'motivo'=>$this->motivo,
            //'estadoA'=>$this->estadoA,
            'empleado_id' => $this->empleadoid
        ]);

        if($this->comprobante){
            $customFileName = uniqid() . '_.' . $this->comprobante->extension();
            $path = $this->comprobante->storeAs('public/assistances', $customFileName);
            $imageTemp = $assistance->comprobante;  // imagen temporal

            $assistance->comprobante = $customFileName;
            $assistance->save();

            if($imageTemp !=null){
                if(file_exists('storage/assistances/' . $imageTemp)){
                    unlink('storage/assistances/' . $imageTemp);
                }
            }

            $fileName = collect(explode('/', $path))->last(); // obtener el nombre de la imagen asignado por laravel
            //dd($fileName);
            $imagex = Image::make(Storage::get($path)); // recuperar la imagen almacenada y crear una nueva instancia

            // reduccion de calidad y compresion de imagen
            $imagex->resize(1280, null, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });

            // por ultimo solo guardamos esta nueva instancia, reemplazando la imagen anterior.
            Storage::put($path, (string) $imagex->encode('jpg', 30));
        }

        $this->resetUI();
        $this->emit('asist-updated','ausencia Actualizada');
    }

    // vaciar formulario
    public function resetUI(){
        $this->fecha='';
        $this->motivo='';
        //$this->estadoA='Elegir';
        $this->empleadoid = 'Elegir';
        $this->image=null;
        $this->search='';
        $this->selected_id=0;
        $this->resetValidation(); // resetValidation para quitar los smg Rojos
    }

    protected $listeners = [
        'deleteRow' => 'Destroy'
    ];

    // eliminar
    public function Destroy(Assistance $assistance){
        $assistance->delete();
        $this->resetUI();
        $this->emit('asist-deleted','Ausencia Eliminada');
    }
}
