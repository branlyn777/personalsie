<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//use Barryvdh\DomPDF\Facade\PDF as PDF;
use Carbon\Carbon;
use App\Models\Employee;
use Barryvdh\DomPDF\Facade as PDF;


class ExportListaEmpleadosController extends Controller
{
    // Reporte de segun export compras con filtro de estados
    // public function getAllEmpleados()
    // {
    //     $empleados = Employee::all();
    //     return view('livewire.employee.component', compact('empleados'));
    // }
    public $nro;

    // public function PrintListaEmpPdf()
    // {
    //     # code...
    // }

    public function downloadPDF($id)
    {
        //$empleados = Employee::all();
        $empleados = Employee::join('area_trabajos as c', 'c.id', 'employees.area_trabajo_id')
        ->join('cargos as pt', 'pt.id', 'employees.cargo_id')
        ->select('employees.*','c.nameArea as area','pt.name as cargo')
        ->get();

        //$nro= $this->nro+1;

        $pdf = PDF::loadView('livewire.employee.listaEmpleados',compact('empleados, nro'));
        return $pdf->setPaper('letter','landscape')->download('ListaEmpleados.pdf');
        
        // https://www.youtube.com/watch?v=YD6v6OeHQMw
    }
}
