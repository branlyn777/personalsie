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
                <input type="text" wire:model="search" placeholder="Nombre de Empleado" class="form-control">
            </div>
        </div>
    
        <div class="col-12 col-sm-6 col-md-4 text-center"></div>

        <div class="col-12 col-sm-12 col-md-4 text-right">
            <a href="javascript:void(0)" class=" btn btn-primary" style="color: #fff" data-toggle="modal"
                data-target="#theModal"">Agregar</a>

            <select wire:model='selected' style="color:black; border-color: blue; text-align: left; background: #fff" class="btn col-lg-4 col-4">
                <option value="Todos">Todos</option>
                <option value="Vigente">Vigente</option>
                <option value="No Vigente">No Vigente</option>
                <option value="Finalizado">Finalizados</option>
            </select>
    
            {{-- <select wire:model='' style="color:black; border-color: blue; text-align: left; background: #fff" class="btn col-lg-4 col-4">
                <option value="null" disabled>Estado</option>
                <option value="Activo">Activo</option>
                <option value="Inactivo">Inactivo</option>
            </select> --}}
        </div>

    </div>
    <br>
    <div class="widget-content">
        <div class="table-responsive">
            <table class="table table-bordered table striped mt-1" >
                <thead class="text-white" style="background: #ee761c">
                    <tr class="text-center">
                        <th>#</th>
                        <th>EMPLEADO</th>
                        <th>FECHA INICIO</th>
                        <th>FECHA FINAL</th>
                        <th>DESCRIPCION</th>
                        <th>SALARIO</th>
                        {{-- <th>ESTADO</th> --}}
                        <th style="width: 230px;">VIGENCIA DE CONTRATO</th>
                        <th style="width: 120px;">ACCION</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($contratos as $datos)
                    <tr class="text-center">
                        <td><h6>{{ ($contratos->currentpage()-1) * $contratos->perpage() + $loop->index + 1 }}</h6></td>
                        <td><h6>{{$datos->name}} {{$datos->lastname}}</h6></td>
                        <td><h6>{{\Carbon\Carbon::parse($datos->fechaInicio)->format('Y-m-d')}}</h6></td>
                        <td><h6>{{\Carbon\Carbon::parse($datos->fechaFin)->format('Y-m-d')}}</h6></td>
                        <td><h6>{{$datos->descripcion}}</h6></td>
                        <td><h6>{{$datos->salario}}</h6></td>

                        {{-- <td class="text-center">
                            <span class="badge {{$datos->estadoC == 'Activo' ? 'badge-success' : 'badge-danger'}}
                                text-uppercase">
                                {{$datos->estadoC}}
                            </span>
                        </td> --}}

                        <td>
                            <span class="badge {{$datos->estadoV == 'Vigente' ? 'badge-info' : 'badge-danger'}}
                                text-uppercase">
                                {{$datos->estadoV}}
                            </span>
                        </td>

                        <td>
                            <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                                <a href="javascript:void(0)" 
                                    wire:click="Edit({{$datos->idContrato}})"
                                    class="btn btn-dark mtmobile" title="Editar">
                                    <i class="fas fa-edit"></i>
                                </a>

                                <a href="{{ url('Contratos/pdf' . '/' . $datos->idContrato)}}"  
                                    class="btn btn-primary mtmobile" title="Imprimir">
                                    <i class="fas fa-print"></i>
                                </a>

                                <a href="javascript:void(0)"
                                wire:click="NoVigente({{$datos->idContrato}})"
                                    class="btn btn-dark" title="Finalizar">
                                    <i class="far fa-times-circle"></i>
                                </a>

                                {{-- <a href="javascript:void(0)"
                                    onclick="Confirmar1('{{$datos->idContrato}}','{{$datos->verificar}}')"
                                    class="btn btn-dark" title="Destroy">
                                    <i class="fas fa-trash"></i>
                                </a> --}}
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table> 
            {{$contratos->links()}}
        </div>
    </div>
    @include('livewire.contrato.form')
</div>

@section('javascript')
<script>
    document.addEventListener('DOMContentLoaded', function(){
        window.livewire.on('show-modal', msg=>{
            $('#theModal').modal('show')
        });
        window.livewire.on('tcontrato-added', msg=>{
            $('#theModal').modal('hide')
            noty(Msg)
        });
        window.livewire.on('tcontrato-updated', msg=>{
            $('#theModal').modal('hide')
        });
    });

    function Confirmar1(id, verificar)
    {
        if(verificar == 'no')
        {
            Swal(
                'Error',
                'No es posible eliminar porque tiene datos relacionados.',
                'error'
            )
            return;
        }
        else
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