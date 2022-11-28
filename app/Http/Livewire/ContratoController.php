<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Contrato;
use App\Models\Employee;
use App\Models\FunctionArea;
use Carbon\Carbon;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

use Illuminate\Support\Facades\DB;

class ContratoController extends Component
{
    use WithFileUploads;
    use WithPagination;

    public $employeeid, $fechaInicio, $fechaFin, $descripcion, $salario, $estadoV, $selected_id; /*, $estadoC*/
    public $pageTitle, $componentName, $search;
    private $pagination = 10;
    public $selected;

    public function mount(){
        $this -> pageTitle = 'Listado';
        $this -> componentName = 'Contrato';
        $this->employeeid = 'Elegir';
        //$this->estadoC = 'Elegir';
        $this->estadoV = 'Elegir';
        $this->selected = 'Todos';
        //$this->funcionid = 'Elegir';

        //$this->fechaFin=Carbon::parse(Carbon::now())->format('Y-m-d');
    }

    public function paginationView()
    {
        return 'vendor.livewire.bootstrap';
    }

    public function render()
    {
        //if(strlen($this->search) > 0)
        if($this->selected == 'Todos')
        {
            $data = Contrato::join('employees as at', 'at.id', 'contratos.Employee_id')
            //->join('function_areas as fun', 'fun.id', 'contratos.funcion_id')
            ->select('contratos.*','at.name as name','contratos.id as idContrato', DB::raw('0 as verificar')) // ,'fun.name as funcion'
            ->orderBy('id','desc')
            ->where('at.name', 'like', '%' . $this->search . '%')
            ->paginate($this->pagination);

            foreach ($data as $os)
            {
                //Obtener los servicios de la orden de servicio
                $os->verificar = $this->verificar($os->idContrato);
            }
        }
        else
        {
  
 
            /* Seleccionar los datos de la base de datos y paginarlos. */
            $data = Contrato::join('employees as at', 'at.id', 'contratos.employee_id')
            //->join('function_areas as fun', 'fun.id', 'contratos.funcion_id') ,'fun.name as funcion'
            ->select('contratos.*','at.name as name',
                DB::raw('0 as year'), DB::raw('0 as mouth'), DB::raw('0 as day'),'contratos.id as idContrato',DB::raw('0 as verificar'))
            ->where('contratos.estadoV', $this->selected)
            ->where(function($querys){
                $querys->where('at.name', 'like', '%' . $this->search . '%');
            })
            ->orderBy('id','desc')
            ->paginate($this->pagination);

            foreach ($data as $os)
            {
                //Obtener los servicios de la orden de servicio idContrato
                $os->verificar = $this->verificar($os->idContrato);
            }

            foreach ($data as $e)
            {
                // Tiempo transcurrido
                $e->year = $this->year($e->id);
                $e->mouth = $this->mouth($e->id);
                $e->day = $this->day($e->id);
            }
        }

        return view('livewire.contrato.component', [
                'contratos' => $data, // se envia contratos
                'empleados' => Employee::orderBy('name', 'asc')->get(),
                //'funciones' => FunctionArea::orderBy('name', 'asc')->get(),
            ])
        ->extends('layouts.theme.app')
        ->section('content');
    }

    // verificar 
    public function verificar($idContrato)
    {
        $consulta = Contrato::where('contratos.id', $idContrato);
       
        if($consulta->count() > 0)
        {
            return "si";
        }
        else
        {
            return "no";
        }
    }

    // TIEMPO TRASCURRIDO
    // años transcurridos
    public function year($id)
    {
        $TiempoTranscurrido = 0;
        $anioInicio = Carbon::parse(Contrato::find($id)->fechaInicio)->format('Y');

        if($anioInicio != Carbon::parse(Carbon::now())->format('Y'))
        {
            $TiempoTranscurrido = Carbon::parse(Carbon::now())->format('Y') - $anioInicio;
        }
        return $TiempoTranscurrido;
    }

    // meses transcurridos
    public function mouth($id)
    {
        $TiempoTranscurrido = 0;
        $meses = Carbon::parse(Contrato::find($id)->fechaInicio)->format('m');
         
        if($meses != Carbon::parse(Carbon::now())->format('m'))
        {
            $TiempoTranscurrido = Carbon::parse(Carbon::now())->format('m') - $meses;
            if($TiempoTranscurrido < 0){
                $TiempoTranscurrido = $TiempoTranscurrido * -1;
            }
        }
        return $TiempoTranscurrido;
    }
    // dias transcurridos
    public function day($id)
    {
        // datos de prueba 
        // 2022-11-04 fecha de inicio 
        // 2022-11-04 fecha final

        // tiempo transcurrido 3 dias
        //restante 5 dias

        $TiempoTranscurrido = 0;
        $meses = Carbon::parse(Contrato::find($id)->fechaInicio)->format('d');
         
        if($meses != Carbon::parse(Carbon::now())->format('d'))
        {
            $TiempoTranscurrido = Carbon::parse(Carbon::now())->format('d') - $meses;
            if($TiempoTranscurrido < 0){
                $TiempoTranscurrido = $TiempoTranscurrido * -1;
            }
        }
        return $TiempoTranscurrido;
    }

    // editar 
    public function Edit($id){
        $record = Contrato::find($id, ['id', 'employee_id', 'fechaInicio', 'fechaFin', 'descripcion', 'salario', 'estadoV']); /*, 'estadoC'*/
        //dd(\Carbon\Carbon::parse($record->fechaFin)->format('Y-m-d'));
        $this->employeeid = $record->employee_id;
        $this->fechaInicio = \Carbon\Carbon::parse($record->fechaInicio)->format('Y-m-d');
        $this->fechaFin = \Carbon\Carbon::parse($record->fechaFin)->format('Y-m-d');
        //Carbon::parse(Carbon::now())->format('Y-m-d');
        $this->descripcion = $record->descripcion;
        $this->salario = $record->salario;
        //$this->funcionid = $record->funcion_id;
        //$this->estadoC = $record->estadoC;
        $this->estadoV = $record->estadoV;
        $this->selected_id = $record->id;

        $this->emit('show-modal', 'show modal!');
    }

    public function NuevoContrato($idContrato)
    {
        $this->emit('show-modal-contrato', 'show modal!');
    }

    public function Store(){
        $rules = [
            'employeeid' => 'required|not_in:Elegir',
            'salario' => 'required',
            'fechaInicio' => 'required',
            'fechaFin' => 'required',
            //'funcionid' => 'required|not_in:Elegir',
            //'estado' => 'required|not_in:Elegir',
        ];
        $messages =  [
            'employeeid.required' => 'Elija un Empleado',
            'employeeid.not_in' => 'Elije un nombre de empleado diferente de elegir',
            'salario.required' => 'El salario es requerido',
            'fechaInicio.required' => 'La fecha de inicio es requerida',
            'fechaFin.required' => 'La fecha de finalizacion es requerida',
            //'funcionid.required' => 'Elija una Funcion',
            //'funcionid.not_in' => 'Elije una funcion diferente de elegir',
            //'estado.required' => 'seleccione estado de contrato',
            //'estado.not_in' => 'selecciona estado de contrato',
        ];

        $this->validate($rules, $messages);
       
        $contrato = Contrato::create([
            'employee_id'=>$this->employeeid,
            'fechaInicio'=>$this->fechaInicio,
            'fechaFin'=>$this->fechaFin,
            'descripcion'=>$this->descripcion,
            'salario'=>$this->salario,
            //'funcion_id'=>$this->funcionid,
            //'estadoC'=>'Activo',
            'estadoV'=>'Vigente'
        ]);

        $this->resetUI();
        $this->emit('tcontrato-added', 'Contrato Registrado');
    }

    // actualizar
    public function Update(){
        $rules = [
            'employeeid' => 'required|not_in:Elegir',
            'salario' => 'required',
            //'funcionid' => 'required|not_in:Elegir',
            //'estado' => 'required|not_in:Elegir',
        ];

        $messages = [
            'employeeid.required' => 'Elija un Empleado',
            'employeeid.not_in' => 'Elije un nombre de empleado diferente de elegir',
            'salario.required' => 'El salario es requerido',
            //'funcionid.required' => 'Elija una Funcion',
            //'funcionid.not_in' => 'Elije una funcion diferente de elegir',
            //'estado.required' => 'seleccione estado de contrato',
            //'estado.not_in' => 'selecciona estado de contrato',
        ];
        $this->validate($rules,$messages);

        $contrato = Contrato::find($this->selected_id);
        $contrato -> update([
            'employee_id'=>$this->employeeid,
            'fechaInicio'=>$this->fechaInicio,
            'fechaFin'=>$this->fechaFin,
            'descripcion'=>$this->descripcion,
            'salario'=>$this->salario,
            //'funcion_id'=>$this->funcionid,
            //'estadoC'=>$this->estadoC,
            'estadoV'=>$this->estadoV
        ]);

        $this->resetUI();
        $this->emit('tcontrato-updated','Contrato Actualizada');
    }

    public function resetUI(){
        $this->employeeid='Elegir';
        $this->fechaInicio='';
        $this->fechaFin='';
        $this->descripcion='';
        //$this->nota='';
        $this->salario='';
        //$this->funcionid='Elegir';
        //$this->estadoC = 'Elegir';
        $this->estadoV = 'Elegir';
        $this->search='';
        $this->selected_id=0;
        $this->resetValidation(); // resetValidation para quitar los smg Rojos
    }

    protected $listeners = [
        'deleteRow' => 'Destroy'
    ];

    // eliminar
    public function Destroy($id)
    {
        $contrato = Contrato::find($id);
        $contrato->delete();
        $this->resetUI();
        $this->emit('tcontrato-deleted','Contrato Eliminada');
    }
    
    // Finalizar Contrato
    public function NoVigente($id)
    {
        $contrato = Contrato::find($id);
        $contrato -> update(['estadoV'=>'No Vigente']);
    }

    public function FunctionName($id)
    {
        // dias restantes
        // public function dayR($idUsuario)
        // {
            $tiempoRestante = 0;
            $tiempoR = Employee::join('employees as emp', 'emp.id', 'contratos.employee_id')
            ->select('contratos.id as idContrato', 'emp.fechaFin as fechafinal')
            ->where('contratos.id', $id)
            ->get()
            ->first();      // permite tomar solo el primer dato
    
            $diasR = Carbon::parse($tiempoR->fechafinal)->format('d');
    
            if($diasR > Carbon::parse(Carbon::now())->format('d'))
            {
                $contrato = Contrato::find($id);
            
                $contrato -> update(['estadoV'=>'No Vigente']);
                //$tiempoRestante = $diasR - Carbon::parse(Carbon::now())->format('d');
            }
            // return $tiempoRestante;
    
    
    }
}