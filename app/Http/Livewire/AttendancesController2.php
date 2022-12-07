<?php

namespace App\Http\Livewire;

use App\Models\Attendance;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class AttendancesController2 extends Component
{
    use WithPagination;
    public $reportType, $userId, $dateFrom, $dateTo, $horaentrada,$horaconformada, $componentName, $title, $fechahoy, $total, $archivo ,$verfiarchivo;
    public $fechaf, $empleadoid, $entradaf, $salidaf, $prueba;

    protected $pagination;

    public function paginationView()
    {
        return 'vendor.livewire.bootstrap';
    }

    public function mount(){
    
        $this->reportType = 0;
        $this->userId = 0;
        $this->dateFrom = Carbon::parse(Carbon::now())->format('Y-m-d');
        $this->dateTo = Carbon::parse(Carbon::now())->format('Y-m-d');
        $this->componentName = "Fallo de Sistema";
        $this->title = "algo";
        $this->fechahoy = Carbon::parse(Carbon::now())->format('Y-m-d');
        
      // 
    }

    public function render()
    {
        $lista_asistencias = Attendance::join("employees as e","e.id","attendances.employee_id")
        ->join("shifts as s","s.ci","e.ci")
        ->select("attendances.fecha as fecha_asistencia","attendances.entrada as entrada_asistencia","attendances.salida as salida_asistencia",
        "e.name as nombreemployees","e.id as idemployees","s.monday as hora_entreda"
        ,DB::raw('0 as dia'),DB::raw('0 as retraso'), DB::raw('0 as Salida_Normal'))
        ->where("e.estado","Activo")
        ->get();

        foreach($lista_asistencias as $s)
        {

            $hora_entreda = new \Carbon\Carbon($s->fecha_asistencia  . $s->entrada_asistencia);
            $hora_entreda_contrado = new \Carbon\Carbon($s->fecha_asistencia . $s->hora_entreda);
            // hora salida si marco o no
            $Salida_Normal = $s->salida_asistencia;

            if($Salida_Normal != 0)
            {
                $s->Salida_Normal = "Salida Normal ";
            }
            else
            {
                $s->Salida_Normal = "No marco salida";
            }



            // $s->retraso = $this->obtener_diferencia_horas( $hora_entreda, $hora_entreda_contrado);
            $s->dia = $this->fecha_dia(Carbon::parse($s->fecha_asistencia)->format('D'));
            $s->retraso = $hora_entreda->diffInMinutes($hora_entreda_contrado);
            

        }
        return view('livewire.attendances.attendances2',[
            'lista_asistencias' => $lista_asistencias,
        ])
        ->extends('layouts.theme.app')
        ->section('content');
        
    }

    public function obtener_diferencia_horas($hora_inicio, $hora_fin)
    {
      
    }

    //convertir dias de ingles a español
    public function fecha_dia($dia)
    {
        switch ($dia) {
            case 'Mon':
                
                return "Lunes";
                break;
            case 'Tue':
                
                return "Martes";
                break;
            case 'Wed':
                
                return "Miercoles";
                break;
            case 'Thu':

                return "Jueves";
                break;
            case 'Fri':


                return "Viernes";
                break;
            case 'Sat':

                return "Sabado";
                break;
            case 'Sun':

                return "Dimingo";
                break;
            default:
                return "no se encontro resultado";
        }
    }
    public function archivo()
    {
        $this->verfiarchivo=1;
    }

    //fallo de sistema agregar manualmente
    public function fallo()
    {
       //validar la fecha dentro del empleado
       $fechap=Attendance::select('attendances.*')
       ->where('attendances.employee_id', $this->empleadoid)
       ->where('fecha','=', $this->fechaf)
       ->get();
       $fechav=$fechap->first();
       //validar para el msg de error
        if($fechav==null){
            $this->prueba=1;
        }
        else{
            $this->prueba=null;
        }
        
        //required_if verifica 
        $rules = [
            'empleadoid' => 'required|not_in:Elegir',
            'fechaf' => "required",
            'prueba' => "required_if:prueba,null"
        
        ];
        $messages =  [
            'empleadoid.required' => 'Elija un Empleado',
            'empleadoid.not_in' => 'Elije un nombre de empleado diferente de elegir',
            'prueba.required_if' => 'Elija una fecha no asignada',
            'fechaf.required' => 'Este espacio es requerida'
        ];
        $this->validate($rules,$messages);
       // dd($this->entradaf);
        $anticipo = Attendance::create([
            'fecha' => $this->fechaf,
            'entrada' => $this->entradaf.':00',
            'salida'=>$this->salidaf.':00',
            'employee_id'=>$this->empleadoid
        ]);

        $this->resetUI();
        $this->emit('asist-fallo','Actualizar Fallo');
    }

    // vaciar formulario
    public function resetUI(){
        
        $this->empleadoid = 'Elegir';
        $this->fechaf = '';
        $this->entradaf='';
        $this->salidaf='';
        $this->resetValidation(); // resetValidation para quitar los smg Rojos
    }

}
