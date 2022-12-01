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
        ->select("attendances.fecha as fecha_asistencia","attendances.entrada as entrada_asistencia","attendances.salida as salida_asistencia", "e.name as nombreemployees"
        ,DB::raw('0 as dia'),DB::raw('0 as retraso'))
        ->where("e.estado","Activo")
        ->get();

        foreach($lista_asistencias as $s)
        {
            $s->dia = $this->fecha_dia(Carbon::parse($s->fecha_asistencia)->format('D'));
            
        }



        return view('livewire.attendances.attendances2',[
            'lista_asistencias' => $lista_asistencias,
        ])
        ->extends('layouts.theme.app')
        ->section('content');
        
    }

    //convertir de ingles a español
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
