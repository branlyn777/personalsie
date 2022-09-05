<?php

use App\Http\Controllers\ExportController;
use App\Http\Livewire\AsignarController;
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\RolesController;
use App\Http\Livewire\PermisosController;
use App\Http\Livewire\UsersController;
use App\Http\Livewire\CompaniesController;
use App\Http\Livewire\SucursalController;
use App\Http\Livewire\EmployeeController;
use App\Http\Livewire\AreaTrabajoController;
use App\Http\Livewire\FunctionAreaController;
use App\Http\Livewire\AreasPermissionsController;
use App\Http\Livewire\AttendancesController;
use App\Http\Livewire\InicioController;
use Illuminate\Support\Facades\Auth;
use App\Http\Livewire\PuestoTrabajoController;
//use App\Http\Livewire\TipoContratoController;
use App\Http\Livewire\ContratoController;

Auth::routes();

Route::middleware(['auth'])->group(function () {
    Route::get('/', InicioController::class)->name('home');
    Route::get('/home', InicioController::class);
    Route::group(['middleware' => ['role:ADMIN']], function () {
    });
    /* ADMINISTRACION */
    Route::get('roles', RolesController::class)->name('roles')->middleware('permission:Roles_Index');
    Route::get('permisos', PermisosController::class)->name('permisos')->middleware('permission:Permission_Index');
    Route::get('asignar', AsignarController::class)->name('asignar')->middleware('permission:Asignar_Index');
    Route::get('users', UsersController::class)->name('usuarios')->middleware('permission:Usuarios_Index');
    Route::get('companies', CompaniesController::class)->name('empresa')->middleware('permission:Empresa_Index');
    Route::get('sucursales', SucursalController::class)->name('sucursal')->middleware('permission:Sucursal_Index');
    Route::get('employees', EmployeeController::class);
    Route::get('areas_de_trabajos', AreaTrabajoController::class);
    Route::get('function_areas', FunctionAreaController::class);
    Route::get('attendance', AttendancesController::class);
    Route::get('areaspermissions', AreasPermissionsController::class);
    Route::get('puesto_trabajos', PuestoTrabajoController::class);
    //Route::get('tipo_contratos', TipoContratoController::class);
    Route::get('contratos', ContratoController::class);
    

     //reporte horario Excel
     Route::get('report/excel/{user}/{type}/{fi}/{f2}', [ExportController::class, 'reporteExcel']);
     Route::get('report/excel/{user}/{type}', [ExportController::class, 'reporteExcel']);
});




