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
        ,DB::raw('0 as dia'),DB::raw('0 as retraso'))
        ->where("e.estado","Activo")
        ->get();

        foreach($lista_asistencias as $s)
        {
            $hora_entreda = new \Carbon\Carbon("2022-12-01 " . $s->entrada_asistencia);
            $hora_entreda_contrado = new \Carbon\Carbon("2022-12-01 " . $s->hora_entreda);



            // $s->retraso = $this->obtener_diferencia_horas( $hora_entreda, $hora_entreda_contrado);

            
            /* $dateTimeObject1 = date_create($s->entrada_asistencia); 
            $dateTimeObject2 = date_create($s->salida_asistencia); 
              
            $difference = date_diff($dateTimeObject1, $dateTimeObject2); 
            echo ("The difference in hours is:");
            echo $difference->h;
            echo "\n";
            $minutes = $difference->days * 24 * 60;
            $minutes += $difference->h * 60;
            $minutes += $difference->i;
            echo("The difference in minutes is:");
            echo $minutes.' minutes';
             */

            $s->retraso = $hora_entreda->diffInHours($hora_entreda_contrado) . ":" . $hora_entreda->diffInMinutes($hora_entreda_contrado);

            $s->dia = $this->fecha_dia(Carbon::parse($s->fecha_asistencia)->format('D'));

        }
        /* dd(  $difference); */



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
}