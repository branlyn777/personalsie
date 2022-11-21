<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//use Barryvdh\DomPDF\Facade\PDF as PDF;
use Carbon\Carbon;
use App\Models\Contrato;
use App\Models\Employee;
use App\Models\AreaTrabajo;
use App\Models\Cargo;
use PDF;

class ExportContratoController extends Controller
{
    //public $id, $employeeid, $fechaInicio, $fechaFin, $descripcion, $salario, $estadoC, $estadoV, $selected_id;
    // public function getAllEmpleados()
    // {
    //     $empleados = Employee::all();
    //     return view('livewire.employee.component', compact('empleados'));
    // }

    public function downloadCPDF()
    {
        // $contratos = Contrato::find($id, ['id', 'employee_id', 'fechaInicio', 'fechaFin', 'descripcion', 'salario', 'estadoC', 'estadoV']);
        // $empleados = Employee::all();
        $contratos = Contrato::join('employees as emp', 'emp.id', 'contratos.Employee_id')
            ->join('area_trabajos as at', 'at.id', 'emp.area_trabajo_id')
            ->join('cargos as cg', 'cg.id', 'emp.cargo_id')
            ->select('contratos.*','emp.*', 'at.nameArea as area','cg.name as cargo')
            ->get();

        // $contratos = Contrato::join('employees as emp', 'emp.id', 'contratos.Employee_id')
        //     ->join('area_trabajos as at', 'at.id', 'emp.area_trabajo_id')
        //     ->join('cargos as cg', 'cg.id', 'emp.cargo_id')
        //     ->select('contratos.*','emp.*', 
        //         'at.nameArea as area',
        //         'cg.name as cargo')
        //     ->where('contratos.id')    // selecciona
        //     ->get()
        //     ->first();
    
        //     //dd($this->name = $detalle->empleado);
    
        //     //$this->idEmpleado = $contratos->idEmpleado;
        //     $this->salario = $contratos->salario;
        //     //$this->image = $contratos->image;

        $pdf = PDF::loadView('livewire.contrato.documentContrato',compact('contratos'));
        return $pdf->setPaper('letter')->download('contrato.pdf');
    }
}
