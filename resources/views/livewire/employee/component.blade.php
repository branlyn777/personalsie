@section('css')
    <style>
        .modal .modal-content { width: 100%; }
    </style>
@endsection

<div>
    <div class="row">
        <div class="col-12 text-center" style="margin-bottom: 50px">
            <p class="h1"><b>{{ $componentName }} | {{ $pageTitle }}</b></p>
        </div>
    </div>
    
    <div class="row">
        <div class="col-lg-4 col-md-4 col-sm-12">
            <div class="input-group mb-4">
                <div class="input-group-prepend">
                    <span class="input-group-text input-gp">
                        <i class="fas fa-search"></i>
                    </span>
                </div>
                <input type="text" wire:model="search" placeholder="Nombre ó CI" class="form-control">
            </div>
        </div>
    
        <div class="col-12 col-sm-6 col-md-4 text-center"></div>

        <div class="col-12 col-sm-12 col-md-4 text-right">
            <a href="javascript:void(0)" class=" btn btn-primary" style="color: #fff" 
                wire:click="NuevoEmpleado()">Agregar</a>

            <a href="{{ url('ListaEmpleados/pdf' . '/' . $idEmpleado)}}"  
                class="btn btn-dark mtmobile">Exportar PDF</a>
              
            <select wire:model='selected' style="color:black; border-color: blue; text-align: left; background: #fff" class="btn col-lg-5 col-4">
                <option value="Todos">Todos</option>
                <option value="Activo">Activo</option>
                <option value="Inactivo">Inactivo</option>
            </select>
        </div>
        
    </div>
    <br>
    <div class="widget-content">
        <div class="table-responsive">
            <table class="table table-hover table table-bordered table-bordered-bd-warning mt-4">
                <thead class="text-white" style="background: #ee761c">
                    <tr class="text-center">
                        <th style="width: 50px;">#</th>
                        <th style="width: 300px;">NOMBRE COMPLETO</th>
                        <th style="width: 70px;">CI</th>
                        <th style="width: 70px;">TELEFONO</th>
                        <th style="width: 280px;">AREA</th>
                        <th style="width: 280px;">CARGO</th>
                        <th>IMAGEN</th>
                        <th>ESTADO</th>
                        <th style="width: 200px;">FECHA DE REG.</th>
                        <th>ACCIONES</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $employee)
                        <tr class="text-center">
                            <td><h6>{{ ($data->currentpage()-1) * $data->perpage() + $loop->index + 1 }}</h6></td>
                            <td><h6>{{ $employee->name }} {{ $employee->lastname }}</h6></td>
                            <td><h6>{{ $employee->ci }}</h6></td>
                            <td><h6>{{ $employee->phone }}</h6></td>
                            <td><h6>{{ $employee->area }}</h6></td>
                            <td><h6>{{ $employee->cargo}}</h6></td>

                            <td>
                                <span>
                                    <img src="{{ asset('storage/employees/' .$employee->image)}}"
                                     alt="Sin Imagen" height="70" width="80" class="rounded">
                                </span>
                            </td>

                            <td>
                                <span class="badge {{$employee->estado == 'Activo' ? 'badge-success' : 'badge-danger'}} 
                                    text-uppercase"> {{$employee->estado}}
                                </span>
                            </td>

                            <td><h6>{{\Carbon\Carbon::parse($employee->created_at)->format('Y-m-d')}}</h6></td>

                            <td>
                                <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                                    <button href="javascript:void(0)" wire:click="Edit({{ $employee->idEmpleado }})"
                                        class="btn btn-dark mtmobile" title="Editar" type="button" class="btn btn-danger">
                                        <i class="fas fa-edit"></i>
                                    </button>

                                    <button href="javascript:void(0)"
                                        onclick="Confirm({{$employee->idEmpleado}},'{{$employee->verificar}}')"
                                        class="btn btn-dark" title="Eliminar" type="button" class="btn btn-warning">
                                        <i class="fas fa-trash"></i>
                                    </button>

                                    <button href="javascript:void(0)"
                                        wire:click="DetalleEmpleado({{$employee->idEmpleado}})"
                                        class="btn btn-dark" title="Detalle" type="button" class="btn btn-success">
                                        <i class="fas fa-list"></i>
                                    </button>

                                    <button href="javascript:void(0)"
                                        wire:click="UsuEmploy({{$employee->idEmpleado}})"
                                        class="btn btn-dark"  title="" type="button" class="btn btn-success">
                                        <i class="fas fa-sync-alt"></i>
                                        {{-- <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" 
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" 
                                        class="feather feather-at-sign"><circle cx="12" cy="12" r="4"></circle>
                                        <path d="M16 8v5a3 3 0 0 0 6 0v-1a10 10 0 1 0-3.92 7.94"></path></svg> --}}
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $data->links() }}
        </div>
    </div>
    @include('livewire.employee.form')
    @include('livewire.employee.detalleEmpleado')
    @include('livewire.employee.formUser')
    @include('livewire.employee.UsuEmploy')
</div>

@section('javascript')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        window.livewire.on('employee-added', msg => {
            $('#theModal').modal('hide')
        });
        window.livewire.on('employee-updated', msg => {
            $('#theModal').modal('hide')
        });
        window.livewire.on('employee-deleted', msg => {
            ///
        });
        window.livewire.on('modal-show', msg => {
            $('#theModal').modal('show')
        });
        window.livewire.on('modal-hide-employee', Msg => {
            $('#theModal').modal('hide')
        })
        // ver detalle de empleados
        window.livewire.on('show-modal-detalleE', Msg => {
            $('#modal-details').modal('show')
        })

        // Abrir siguiente modal
        window.livewire.on('show-modal-formUser', Msg => {
            $('#theModal-formUser').modal('show')
        })
        window.livewire.on('formUser-added', msg => {
            $('#theModal-formUser').modal('hide')
        });
        window.livewire.on('modal-hide-formUser', Msg => {
            $('#theModal-formUser').modal('hide')
        })
        // Abrir UsuarioEmploy
        window.livewire.on('show-modal-UsuEmp', Msg => {
            $('#theModal-UsuEmp').modal('show')
        })
        window.livewire.on('UsuEmp-added', msg => {
            $('#theModal-UsuEmp').modal('hide')
        });
        window.livewire.on('UsuEmp-updated', msg => {
            $('#theModal-UsuEmp').modal('hide')
        });
    });

    function Confirm(id, verificar) {
        if(verificar == 'no')
        {
            Swal(
                'Error',
                'No es posible eliminar porque tiene datos relacionados.',
                'error'
            )
            // swal('no es posible eliminar porque tiene datos relacionados')
            return;
        }else
        {
            swal({
                title: 'CONFIRMAR',
                text: "¿CONFIRMAS ELIMINAR EL REGISTRO?",
                type: 'warning',
                showCancelButton: true,
                cancelButtonText: 'Cancelar',
                confirmButtonText: 'Aceptar',
                padding: '2em'
            }).then(function(result){
            if (result.value){
                    window.livewire.emit('deleteRow', id)
                }
            })
        }
    }
</script>
<!-- Scripts para el mensaje de confirmacion arriba a la derecha Categoría Creada con Éxito y Alerta de Eliminacion -->
<script src="{{ asset('plugins/sweetalerts/sweetalert2.min.js') }}"></script>
<script src="{{ asset('plugins/sweetalerts/custom-sweetalert.js') }}"></script>
<!-- Fin Scripts -->
@endsection