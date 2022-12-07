<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;
use Carbon\Carbon;
use App\Models\Contrato;
use App\Models\Employee;
use App\Models\AreaTrabajo;
use App\Models\Assistance;

class ExportReportPermisosController extends Controller
{
    public $nro;
    public function ReportePermisosPDF($idAsistencia)
    {
        //dd('Prueba de Exportacion de Contrato');
        $empleado = Assistance::join('employees as emp', 'emp.id', 'assistances.empleado_id')
        ->join('area_trabajos as at', 'at.id', 'emp.area_trabajo_id')
        ->join('cargos as cg', 'cg.id', 'emp.cargo_id')
        ->select('assistances.*','emp.*', 'at.nameArea as area','cg.name as cargo')
        ->where('assistances.id', $idAsistencia)
        ->get();
        //->first();
        $nro= $this->nro+1;

        $pdf = PDF::loadView('livewire.pdf.ReportePermisos',compact('empleado', 'nro'));
        return $pdf->setPaper('letter')->download('ReporteDePermisos.pdf');
    }
}
