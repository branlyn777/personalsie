<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\PDF as PDF;
use Carbon\Carbon;
use App\Models\AreaTrabajo;
use App\Models\Cargo;
use App\Models\Employee;


class ExportListaEmpleadosController extends Controller
{
    //public $employeeid; 
    public function PrintEmpleadosPDF($employeeid/*, $fromDate = null, $toDate = null*/)
    {
        $data = [];

        // $fi = Carbon::parse($fromDate)->format('Y-m-d') . ' 00:00:00';
        // $ff = Carbon::parse($toDate)->format('Y-m-d') . ' 23:59:59';

        $data = Employee::join('area_trabajos as c', 'c.id', 'employees.area_trabajo_id') // se uno amabas tablas
        ->join('cargos as pt', 'pt.id', 'employees.cargo_id')
        ->where('estado','Activo')
        ->where('employees.id', $employeeid)
        ->get();

        $empleados = $employeeid == 0 ? 'Todos' : Employee::find($employeeid)->name;
        
        $pdf = PDF::loadView('pdf.reporteListaEmpleado', compact('data','empleados'));
        
        return $pdf->stream('ListaEmpleados.pdf'); // visualizar
        return $pdf->download('ListaEmpleados.pdf');// descargar
 
    }

}
