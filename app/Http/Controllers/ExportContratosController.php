<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;
use Carbon\Carbon;
use App\Models\Contrato;
use App\Models\Employee;
use App\Models\AreaTrabajo;

class ExportContratosController extends Controller
{
    public function PrintContratoPdf($idContrato)
    {
        //dd('Prueba de Exportacion de Contrato');
        $empleado = Contrato::join('employees as emp', 'emp.id', 'contratos.Employee_id')
        ->join('area_trabajos as at', 'at.id', 'emp.area_trabajo_id')
        ->join('cargos as cg', 'cg.id', 'emp.cargo_id')
        ->select('contratos.*','emp.*', 'at.nameArea as area','cg.name as cargo')
        ->where('contratos.id', $idContrato)
        ->get();
        //->first();
        //$this->name = $detalle->name;

        $pdf = PDF::loadView('livewire.pdf.ImprimirContrato',compact('empleado'));
        return $pdf->setPaper('letter')->download('contrato.pdf');
    }
}
