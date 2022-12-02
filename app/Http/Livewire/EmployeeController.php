<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Cargo;
use App\Models\AreaTrabajo;
use App\Models\Employee;
use Livewire\withPagination;
use Livewire\withFileUploads;
use App\Models\Contrato;
use App\Models\Shift;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

use Intervention\Image\ImageManagerStatic as Image;
//use Intervention\Image\Facades\Image;

// elementos de prueba forma de compresion de img
use Illuminate\Http\Request;

// creacion datos de usuario
use App\Models\Sucursal;
use App\Models\SucursalUser;
use App\Models\User;
use FontLib\Table\Type\name;
use Spatie\Permission\Models\Role;

// Usuario Empleado
use App\Models\UserEmployee;

class EmployeeController extends Component
{
    use withPagination;
    use withFileUploads;

    // Datos de Empleados
    public $idEmpleado, $ci, $name, $lastname, $genero, $dateNac, $address, $phone, $estadoCivil, $image, $estado, $selected_id;
    public $cargoid = null, $areaid = null, $cargos = null;
    public $pageTitle, $componentName, $search;
    private $pagination = 12;
    public $selected;

    // Datos de Usuario
    public $idUsuario, $nameu, $phoneu, $email, $profile, $status, $password, $imageu, $selected_user_id;
    public $componentNameU;

    // Datos Sucursal Usuario
    public $sucursalUsuario, $sucursal_id;

    // Datos de Usuario Empleado
    public $empleadoid, $userid, $selected_EU_id;
    public $idUserEmploy;

    public function paginationView()
    {
        return 'vendor.livewire.bootstrap';
    }

    public function mount(){
        $this->pageTitle = 'Listado';
        $this->componentName = 'Empleados';

        $this->areaid = 'null';   // null
        $this->cargoid = 'null';  // null
        $this->genero = 'Seleccionar';
        $this->estadoCivil = 'Seleccionar';

        //$this->selected_id = 'Todos';
        $this->estado = 'Elegir';
        $this->selected = 'Todos';
        
        $this->idEmpleado = 0;

        // Usuario
        $this->componentNameU = 'Usuario';
        $this->profile = 'Elegir';

        // Sucursal Ususario
        $this->sucursal_id = 'Elegir';

        // Usuario Empleado
        $this -> empleadoid = 'Elegir';
        $this -> userid = 'Elegir';
    }
    // https://styde.net/manejo-de-cadenas-de-texto-con-laravel/

    public function render()
    {
            if ($this->selected == 'Todos') {
                $employ = Employee::join('area_trabajos as c', 'c.id', 'employees.area_trabajo_id')
                ->join('cargos as pt', 'pt.id', 'employees.cargo_id')
                ->select('employees.*','c.nameArea as area','pt.name as cargo', 'employees.id as idEmpleado', DB::raw('0 as verificar'))
                ->where('employees.name', 'like', '%' . $this->search . '%')    // busquedas employees
                    ->orWhere('employees.ci', 'like', '%' . $this->search . '%')
                ->orderBy('employees.created_at', 'desc')
                ->paginate($this->pagination);

                foreach ($employ as $os)
                {
                    //Obtener los servicios de la orden de servicio
                    $os->verificar = $this->verificar($os->idEmpleado);
                }
            }else{
                $employ = Employee::join('area_trabajos as c', 'c.id', 'employees.area_trabajo_id')
                ->join('cargos as pt', 'pt.id', 'employees.cargo_id')
                ->select('employees.*','c.nameArea as area','pt.name as cargo', 'employees.id as idEmpleado', DB::raw('0 as verificar'))
                ->where('employees.estado',$this->selected)  // segun  estado
                ->where(function($querys){
                    $querys->where('employees.name', 'like', '%' . $this->search . '%')    // busquedas employees
                    ->orWhere('employees.ci', 'like', '%' . $this->search . '%') ;   // busquedas
                })
                ->orderBy('employees.created_at', 'desc')
                ->paginate($this->pagination);

                foreach ($employ as $os)
                {
                    //Obtener los servicios de la orden de servicio
                    $os->verificar = $this->verificar($os->idEmpleado);
                }
            }

        return view('livewire.employee.component', [
            'data' => $employ,    //se envia data
            //'areas' => AreaTrabajo::orderBy('nameArea', 'asc')->get(),
            //'cargos' => Cargo::orderBy('name', 'asc')->get(), // Cargo
            'roles' => Role::orderBy('name', 'asc')->get(),     // roles
            'sucursales' => Sucursal::orderBy('name', 'asc')->get(),    // sucursales
            'usuarios' => User::orderBy('name', 'asc')->get(),
            'empleados' => Employee::orderBy('name', 'asc')->get(),
            'areas' => AreaTrabajo::where('estadoA', 'Activo')->orderBy('nameArea', 'asc')->get(),
        ])
        ->extends('layouts.theme.app')
        ->section('content');
    }

    // ver selecion de cargos
    public function updatedareaid($area_id)
    {
        $this->cargos = Cargo::where('area_id',$area_id)->get();

    }

    // verificar empleado
    public function verificar($idEmpleado)
    {
        $consulta = Employee::join('assistances as a', 'a.empleado_id', 'employees.id')
        ->select('employees.*')
        ->where('employees.id', $idEmpleado)
        ->get();

        $consulta2 = Employee::join('contratos as ct', 'ct.employee_id', 'employees.id')
        ->select('employees.*')
        ->where('employees.id', $idEmpleado)
        ->get();

        $consulta3 = Employee::join('attendances as ats', 'ats.employee_id', 'employees.id')
        ->select('employees.*')
        ->where('employees.id', $idEmpleado)
        ->get();

        $consulta4 = Employee::join('anticipos as atp', 'atp.empleado_id', 'employees.id')
        ->select('employees.*')
        ->where('employees.id', $idEmpleado)
        ->get();

        $consulta5 = Employee::join('discountsvs as dv', 'dv.ci', 'employees.id')
        ->select('employees.*')
        ->where('employees.id', $idEmpleado)
        ->get();

        $consulta6 = Employee::join('shifts as sht', 'sht.ci', 'employees.id')
        ->select('employees.*')
        ->where('employees.id', $idEmpleado)
        ->get();

        $consulta7 = Employee::join('commissions_employees as com', 'com.user_id', 'employees.id')
        ->select('employees.*')
        ->where('employees.id', $idEmpleado)
        ->get();

        $consulta8 = Employee::join('user_employees as ue', 'ue.employee_id', 'employees.id')
        ->select('employees.*')
        ->where('employees.id', $idEmpleado)
        ->get();

        if($consulta->count() > 0 || $consulta2->count() > 0 || $consulta3->count() > 0 || $consulta4->count() > 0 || $consulta5->count() > 0 || $consulta6->count() > 0 || $consulta7->count() > 0 || $consulta8->count() > 0)
        {
            return "no";
        }
        else
        {
            return "si";
        }
    }

    // Abre el modal de Nuevo empleado
    public function NuevoEmpleado()
    {
        $this->resetUI();
        $this->emit('modal-show', 'show modal!');
    }

    // modal de Detalle de empleados
    public function DetalleEmpleado($idEmpleado)
    {
        $this->ServicioDetalle($idEmpleado);
        $this->emit('show-modal-detalleE', 'open modal');
    }

    // detalle de empleados
    public function ServicioDetalle($idEmpleado)
    {
        $detalle = Employee::join('area_trabajos as at', 'at.id', 'employees.area_trabajo_id')
        ->join('cargos as pt', 'pt.id', 'employees.cargo_id')
        // ->join('users as usu', 'usu.phone', 'employees.phone')
        ->select('employees.id as idEmpleado',
            'employees.ci',
            'employees.name',
            'employees.lastname',
            'employees.genero',
            'employees.dateNac',
            'employees.address',
            'employees.phone',
            'employees.estadoCivil',
            'employees.image',
            'at.nameArea as nombrearea',
            'pt.name as nombrecargo',
            // 'usu.email',
            // 'usu.phone as cel',
            // 'usu.id as idUsuario',
            )
        ->where('employees.id', $idEmpleado)    // selecciona al empleado
        ->get()
        ->first();

        //dd($detalle->name);
        $this->idEmpleado = $detalle->idEmpleado;
        $this->ci = $detalle->ci;
        $this->name = $detalle->name;
        $this->lastname = $detalle->lastname;
        $this->genero = $detalle->genero;
        $this->dateNac = $detalle->dateNac;
        $this->address = $detalle->address;
        $this->phone = $detalle->phone;
        $this->estadoCivil = $detalle->estadoCivil;
        $this->areaid = $detalle->nombrearea;
        $this->cargoid = $detalle->nombrecargo;
        $this->image = $detalle->image;

        // $this->email = $detalle->email;
        // $this->phoneu = $detalle->cel;
        // $this->idUsuario = $detalle->idUsuario;
    }

    // Registro de empleado nuevo
    public function Store()
    {
        $rules = [
            'ci' => 'required|unique:employees',
            'name' => 'required|regex:/^[\pL\s\-]+$/u', //'name' => 'required|alpha', validacion de solo letras
            'lastname' => 'required|regex:/^[\pL\s\-]+$/u',
            'genero' => 'required|not_in:Seleccionar',
            'dateNac' => 'required',
            //'address' => 'required',
            'phone' => 'required|digits_between:8,8',
            //'estadoCivil' => 'required|not_in:Seleccionar',
            'areaid' => 'required|not_in:Elegir',
            'cargoid' => 'required|not_in:Elegir',
            //'image' => 'required', //'max:2048'
            'image' => 'nullable|mimes:jpeg,png,jpg,gif,svg'
        ];
        $messages =  [
            'ci.required' => 'numero de cedula de identidad requerida',
            'ci.unique' => 'ya existe el numero de documento en el sistema',
            'name.required' => 'el nombre de empleado es requerida',
            'name.regex' => 'Solo se permite letras',
            'lastname.required' => 'los apellidos del empleado son requerida',
            'lastname.regex' => 'Solo se permite letras',
            'genero.required' => 'seleccione el genero del empleado',
            'genero.not_in' => 'selecciona genero',
            'dateNac.required' => 'la fecha de nacimiento es requerido',
            //'address.required' => 'la direccion es requerida',
            'phone.required' => 'el numero de telefono es requerido',
            'phone.digits_between' => 'Solo se permite 8 numeros',
            //'estadoCivil.required' => 'seleccione estado civil del empleado',
            //'estadoCivil.not_in' => 'selecciona estado civil',
            'areaid.not_in' => 'elije un nombre de area diferente de elegir',
            'cargoid.not_in' => 'elije un nombre del cargo diferente de elegir',
            //'image.required' => 'la image es requerida seleccione una'
            //'image.max' => 'La imagen no debe ser superior a 2048 kilobytes.',
            'image.mimes' => 'Solo se permite imagen'
        ];

        $this->validate($rules, $messages);

        $employ = Employee::create([
            'ci' =>$this->ci, 
            'name'=>$this->name,
            'lastname'=>$this->lastname,
            'genero'=>$this->genero,
            'dateNac'=>$this->dateNac,
            'address'=>$this->address,
            'phone'=>$this->phone,
            'estadoCivil'=>$this->estadoCivil,
            'area_trabajo_id' => $this->areaid,
            'cargo_id' => $this->cargoid,
            'estado' => 'Activo'
            //'contrato_id' => $this->contratoid,
            //'fechaInicio'=>$this->fechaInicio,
            //'image'=>  $customFileName,
        ]);

        $this->idEmpleado = $employ->id;

        $turno = Shift::create([
            'ci' => $this->ci,
            'name' => $this->name,
            'monday' => '08:00:00',
            'tuesday' => '08:00:00',
            'wednesday' => '08:00:00',
            'thursday' => '08:00:00',
            'friday' => '08:00:00',
            'saturday' => '08:00:00'
        ]);

        //$customFileName;
        if($this->image)
        {
            // guardar nueva imagen
            $customFileName = uniqid() . '_.' . $this->image->extension();
            $path = $this->image->storeAs('public/employees', $customFileName);
            $employ->image = $customFileName;
            $employ->save();

            //dd('hola');
            // proceso de compresion de imagen
            $fileName = collect(explode('/', $path))->last(); // obtener el nombre de la imagen asignado por laravel
            $imagex = Image::make(Storage::get($path)); // recuperar la imagen almacenada y crear una nueva instancia
            
            // reduccion de calidad y compresion de imagen
            $imagex->resize(1280, null, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });
            //dd($imagex);

            // por ultimo solo guardamos esta nueva instancia, reemplazando la imagen anterior.
            Storage::put($path, (string) $imagex->encode('jpg', 30));
        }
        //$employ->save();

        //https://hcastillaq.medium.com/comprimiendo-im%C3%A1genes-con-laravel-ccc92a0d45e5
        
        //$this->resetUI();
        $this->emit('employee-added', 'Empleado Registrado');
        $this->emit('modal-show', 'show modal!');

        // Abrir modal de Nuevo Usuario
        $this->emit('modal-hide-employee', 'show modal!');
        $this->emit('show-modal-formUser', 'show modal!');
    }

    // Registro de nuevo usuario
    public function NuevoUsuario()
    {
        $rules = [
            //'nameu' => 'required|min:3',
            'email' => 'required|unique:users|email',
            'profile' => 'required|not_in:Elegir',
            'password' => 'required|min:3',
            // 'sucursal_id' => 'required|not_in:Elegir',
        ];
        $messages =  [
            // 'nameu.required' => 'Ingresa el nombre del usuario',
            // 'nameu.min' => 'El nombre del usuario debe tener al menos 3 caracteres',
            'email.required' => 'Ingresa una direccion de correo electrónico',
            'email.email' => 'Ingresa una dirección de correo válida',
            'email.unique' => 'El email ya existe en el sistema',
            'profile.required' => 'Selecciona el perfil/rol del usuario',
            'profile.not_in' => 'Seleccioa un perfil/rol distinto a Elegir',
            'password.required' => 'Ingresa el password',
            'password.min' => 'El password debe tener al menos 3 caracteres',
            // 'sucursal_id.required' => 'Seleccione la sucursal del usuario',
            // 'sucursal_id.not_in' => 'Seleccione una sucursal distinto a Elegir',
        ];
 
        $this->validate($rules, $messages);

        // $collection = collect(['@sie.com']);
        $user = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'status' => 'ACTIVE',
            'profile' => $this->profile,
            'password' => bcrypt($this->password)
        ]);

        $user->syncRoles($this->profile);

        if ($this->image) {
            $customFileName = uniqid() . '_.' . $this->image->extension();
            $path = $this->image->storeAs('public/usuarios', $customFileName);
            $user->image = $customFileName;
            $user->save();

            // proceso de compresion de imagen
            $fileName = collect(explode('/', $path))->last(); // obtener el nombre de la imagen asignado por laravel
            $imagex = Image::make(Storage::get($path)); // recuperar la imagen almacenada y crear una nueva instancia
            
            // reduccion de calidad y compresion de imagen
            $imagex->resize(1280, null, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });
            //dd($imagex);

            // por ultimo solo guardamos esta nueva instancia, reemplazando la imagen anterior.
            Storage::put($path, (string) $imagex->encode('jpg', 30));
        }

        SucursalUser::create([
            'user_id' => $user->id,
            'sucursal_id' => $this->sucursal_id,
            'estado' => 'ACTIVO',
            'fecha_fin' => null,
        ]);

        $this->idUsuEmp = UserEmployee::create([
            'user_id' =>$user->id,
            'employee_id' =>$this-> idEmpleado
        ]);

        //$user->save();
        $this->resetUS();
        $this->emit('formUser-added','Usuario Registrado');
        $this->emit('modal-hide-formUser', 'show modal!');
    }

    // Editar Datos de Usuario Empleado
    public function UsuEmploy($idEmpleado)
    {
        //$idEmpleado->delete();

        $detalle = Employee::join('users as usu', 'usu.phone', 'employees.phone')
        ->select('employees.id as idEmpleado',
            'employees.name',
            'employees.lastname',
            'usu.email',
            'usu.id as idUsuario',
            )
        ->where('employees.id',$idEmpleado)    // selecciona al empleado
        ->get()
        ->first();
        
        //dd($detalle);
        
        $this->name = $detalle->name;
        $this->lastname = $detalle->lastname;

        //UserEmployee::find($idEmpleado)->delete();
        
        $this->emit('show-modal-UsuEmp', 'show modal!');
                
        // Registra datos de empleado Usuario
        $usuEmp = new UserEmployeeController;
        $usuEmp->selected_EU_id=$this->selected_EU_id;
        $usuEmp->userid = $this->userid;
        $usuEmp->empleadoid= $this->idEmpleado = $detalle->idEmpleado;
        $usuEmp->Store();
        
        $this->resetUS();
        $this->emit('UsuEmp-added','Usuario Actualizado');
    }

    // Reset de Usuario
    public function resetUS()
    {
        $this->nameu = '';
        $this->email = '';
        $this->password = '';
        $this->phoneu = '';
        //$this->image = null;
        $this->profile = 'Elegir';
        $this->sucursal_id = 'Elegir';
        $this->selected_user_id = 0;
        $this->resetValidation();

        $this->userid = 'Elegir';
        $this->empleadoid = 'Elegir';
    }

    // Abrir modal con la informacion
    public function Edit(Employee $employee){

        $this->ci = $employee->ci;
        $this->name = $employee->name;
        $this->lastname = $employee->lastname;
        $this->genero = $employee->genero;
        $this->dateNac = \Carbon\Carbon::parse($employee->dateNac)->format('Y-m-d') ;
        $this->address = $employee->address;
        $this->phone = $employee->phone;
        $this->estadoCivil = $employee->estadoCivil;
        $this->areaid = $employee->area_trabajo_id;
        $this->cargoid = $employee->cargo_id;
        $this->image = $employee->null;
        $this->estado = $employee->estado;
        $this->selected_id = $employee->id;

        $this->emit('modal-show', 'Show modal!');
    }

    // actulizar informacion
    public function Update(){
        $rules = [
            'ci' => "required|unique:employees,ci,{$this->selected_id}",
            'name' => 'required',
            'lastname' => 'required',
            'genero' => 'required|not_in:Seleccionar',
            'dateNac' => 'required',
            //'address' => 'required',
            'phone' => 'required|digits_between:8,8',
            //'estadoCivil' => 'required|not_in:Seleccionar',
            'areaid' => 'required|not_in:Elegir',
            'cargoid' => 'required|not_in:Elegir',
            //'image' => 'max:2048',
            'image' => 'nullable|mimes:jpeg,png,jpg,gif,svg'
        ];
        $messages =  [
            'ci.required' => 'numero de cedula de identidad requerida',
            'ci.unique' => 'ya existe el numero de documento en el sistema',

            'name.required' => 'el nombre de empleado es requerida',
            'lastname.required' => 'los apellidos del empleado son requerida',

            'genero.required' => 'el genero del empleado es requerido',
            'genero.not_in' => 'selcciona genero',

            'dateNac.required' => 'la fecha de nacimiento es requerido',

            //'address.required' => 'la direccion es requerida',
            'phone.required' => 'el numero de telefono es requerido',
            'phone.digits_between' => 'Solo se permite 8 numeros',

            //'estadoCivil.required' => 'seleccione estado civil del empleado',
            //'estadoCivil.not_in' => 'selecciona estado civil',

            'areaid.not_in' => 'elije un nombre de area diferente de elegir',

            'cargoid.not_in' => 'elije un nombre del cargo diferente de elegir',
            //'image.required' => 'Seleccione una imagen no superior a 2048 kilobytes',
            //'image.max' => 'La imagen no debe ser superior a 2048 kilobytes.',
            'image.mimes' => 'Solo se permite imagen'
        ];

        $this->validate($rules, $messages);

        $employee = Employee::find($this->selected_id);
        $employee->update([
            'ci' => $this->ci,
            'name' => $this->name,
            'lastname' => $this->lastname,
            'genero' => $this->genero,
            'dateNac' => $this->dateNac,
            'address' => $this->address,
            'phone' => $this->phone,
            'estadoCivil'=>$this->estadoCivil,
            'area_trabajo_id' => $this->areaid,
            'cargo_id' => $this->cargoid,
            'estado'=>$this->estado
            //'contrato_id' => $this->contratoid,
            //'fechaInicio' => $this->fechaInicio,
        ]);

        if($this->image){
            $customFileName = uniqid() . '_.' . $this->image->extension();
            $path = $this->image->storeAs('public/employees', $customFileName);
            $imageTemp = $employee->image;  // imagen temporal

            $employee->image = $customFileName;
            $employee->save();

            if($imageTemp !=null){
                if(file_exists('storage/employees/' . $imageTemp)){
                    unlink('storage/employees/' . $imageTemp);
                }
            }

            $fileName = collect(explode('/', $path))->last(); // obtener el nombre de la imagen asignado por laravel
            //dd($fileName);
            $imagex = Image::make(Storage::get($path)); // recuperar la imagen almacenada y crear una nueva instancia

            // reduccion de calidad y compresion de imagen
            $imagex->resize(1280, null, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });

            // por ultimo solo guardamos esta nueva instancia, reemplazando la imagen anterior.
            Storage::put($path, (string) $imagex->encode('jpg', 30));
        }

        $employee->save();

        $this->resetUI(); // limpia las cajas de texto
        $this->emit('employee-updated', 'Datos de Empleado Actualizado');
    }

    // limpiar formulario
    public function resetUI(){
        $this->ci = '';
        $this->name = '';
        $this->lastname = '';
        $this->genero = 'Seleccionar';
        $this->dateNac = '';
        $this->address = '';
        $this->phone = '';
        $this->estadoCivil = 'Seleccionar';
        $this->areaid = 'Elegir';
        $this->cargoid = 'Elegir';
        //$this->contratoid = 'Elegir';
        //$this->fechaInicio = '';
        $this->image=null;
        $this->estado = 'Elegir';
        $this->search = '';
        $this->selected_id = 0;

        $this->resetValidation(); // resetValidation para quitar los smg Rojos
    }

    protected $listeners = [
        'deleteRow' => 'Destroy'
    ];

    // eliminar informacion
    public function Destroy($id)
    {
        $employee = Employee::find($id);
        $imageName = $employee->image; //imagen temporal
        $employee->delete();

        if($imageName !=null){
            unlink('storage/employees/' . $imageName);
        }

        $this->resetUI();
        $this->emit('employee-deleted','Empleado Eliminado');
    }
}
