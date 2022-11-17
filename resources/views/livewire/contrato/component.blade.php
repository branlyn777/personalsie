<div class="row sales layout-top-spacing">
    <div class="col-sm-12">
        <div class="widget widget-chart-one">
            <div class="widget-heading">
                <h4 class="card-title">
                    <b>{{$componentName}} | {{$pageTitle}}</b>
                </h4>
                <ul class="tabs tab-pills">
                    <a href="javascript:void(0)" class="btn btn-primary" data-toggle="modal"
                        data-target="#theModal">Agregar</a>
                </ul>
            </div>
            
            @include('common.searchbox')
            
            <div class="widget-content">
                <div class="table-responsive">
                    <table class="table table-bordered table striped mt-1" >
                        <thead class="text-white" style="background: #ee761c">
                            <tr>
                                <th class="table-th text-withe">#</th>
                                <th class="table-th text-white">EMPLEADO</th>
                                <th class="table-th text-white">FECHA INICIO</th>
                                <th class="table-th text-white">FECHA FINAL</th>
                                <th class="table-th text-white">DESCRIPCION</th>
                                <th class="table-th text-white">SALARIO</th>
                                {{-- <th class="table-th text-white text-center">FUNCIONES</th> --}}
                                <th class="table-th text-white text-center">ESTADO</th>
                                <th class="table-th text-white text-center">VIGENCIA DE CONTRATO</th>
                                <th class="table-th text-withe text-center">TIEMPO TRANCURRIDO</th>
                                <th class="table-th text-white text-center">ACCION</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($contratos as $datos)
                            <tr>
                                <td><h6>{{ ($contratos->currentpage()-1) * $contratos->perpage() + $loop->index + 1 }}</h6></td>
                                <td><h6>{{$datos->name}}</h6></td>
                                <td><h6>{{\Carbon\Carbon::parse($datos->fechaInicio)->format('Y-m-d')}}</h6></td>
                                <td><h6>{{\Carbon\Carbon::parse($datos->fechaFin)->format('Y-m-d')}}</h6></td>
                                <td><h6>{{$datos->descripcion}}</h6></td>
                                <td><h6>{{$datos->salario}}</h6></td>
                                {{-- <td><h6>{{$datos->funcion}}</h6></td> --}}

                                <td class="text-center">
                                    <span class="badge {{$datos->estadoC == 'Activo' ? 'badge-success' : 'badge-danger'}}
                                        text-uppercase">
                                        {{$datos->estadoC}}
                                    </span>
                                </td>

                                <td class="text-center">
                                    <span class="badge {{$datos->estadoV == 'Vigente' ? 'badge-info' : 'badge-danger'}}
                                        text-uppercase">
                                        {{$datos->estadoV}}
                                    </span>
                                </td>

                                <td>
                                    <h6 class="text-center">
                                        @if($datos->year != 0)
                                            {{$datos->year}} años
                                        @endif

                                        @if($datos->mouth != 0)
                                            {{$datos->mouth}} meses
                                        @endif

                                        @if($datos->day != 0)
                                            {{$datos->day}} dias
                                        @endif
                                    </h6>
                                </td>
                               
                                {{-- @if($datos->estado == 'Finalizado')
                                    <td class="text-center" hidden>
                                        <a href="javascript:void(0)" 
                                            wire:click="Edit({{$datos->idContrato}})"
                                            class="btn btn-dark mtmobile" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>

                                        <a href="javascript:void(0)"
                                        onclick="Confirmar1('{{$datos->idContrato}}','{{$datos->verificar}}')"
                                        class="btn btn-dark" title="Destroy">
                                        <i class="far fa-times-circle"></i>
                                        </a>
                                    </td>
                                @else --}}
                                <td class="text-center">
                                    <a href="javascript:void(0)" 
                                        wire:click="Edit({{$datos->idContrato}})"
                                        class="btn btn-dark mtmobile" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>

                                    {{-- <a href="javascript:void(0)"
                                    onclick="Confirmar1('{{$datos->idContrato}}','{{$datos->verificar}}')"
                                    class="btn btn-dark" title="Destroy">
                                    <i class="far fa-times-circle"></i>
                                    </a> --}}
                                </td>
                                {{-- @endif --}}
                            </tr>
                            @endforeach
                        </tbody>
                    </table> 
                    {{$contratos->links()}}
                </div>
            </div>
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
                text: "¿FINALIZAR CONTRATO?",
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