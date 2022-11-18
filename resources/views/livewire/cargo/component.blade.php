<div class="row sales layout-top-spacing">
    <div class="col-sm-12">
        <div class="widget widget-chart-one">
            <div class="widget-heading">
                <h4 class="card-title">
                    <b>{{$componentName}} | {{$pageTitle}}</b>
                </h4>
                <ul class="tabs tab-pills">
                    {{-- <a href="javascript:void(0)" class="btn btn-primary" data-toggle="modal" 
                    data-target="#theModal">Agregar</a> --}}
                    <a href="javascript:void(0)" class=" btn btn-primary" style="color: #fff" data-toggle="modal"
                    data-target="#theModal"">Agregar</a>
                </ul>
            </div>

            @include('common.searchbox')

            <div class="widget-content">
                <div class="table-responsive">
                    <table class="table table-bordered table striped mt-1" >
                        <thead class="text-white" style="background: #ee761c">
                            <tr>
                               <th class="table-th text-white">#</th>
                               <th class="table-th text-white">CARGO</th>
                               <th class="table-th text-white text-center">AREA</th>
                               <th class="table-th text-white text-center">FUNCIONES</th>
                               <th class="table-th text-white text-center">ESTADO</th>
                               <th class="table-th text-white text-center">ACTIONS</th> 
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($cargos as $cargo)
                            <tr>
                                <td><h6>{{($cargos->currentpage()-1) * $cargos->perpage() + $loop->index + 1}}</h6></td>
                                <td><h6>{{$cargo->name}}</h6></td>
                                <td><h6 class="text-center">{{$cargo->area}}</h6></td>

                                <td class="text-center">
                                    <a href="javascript:void(0)"
                                        wire:click="VistaFuncion({{$cargo->idcargo}})" 
                                        class="btn btn-primary mtmobile" title="Ver">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                </td>

                                <td class="text-center">
                                    <span class="badge {{$cargo->estado == 'Disponible' ? 'badge-success' : 'badge-danger'}}
                                        text-uppercase">
                                        {{$cargo->estado}}
                                    </span>
                                </td>

                                <td class="text-center">
                                    <a href="javascript:void(0)"
                                        wire:click="NuevaFuncion({{$cargo->idcargo}})" 
                                        class="btn btn-primary close-btn" title="Agregar">
                                        <i class="fas fa-plus-circle"></i>
                                    </a>

                                    <a href="javascript:void(0)" 
                                        wire:click="Edit({{$cargo->idcargo}})"
                                        class="btn btn-dark mtmobile" title="Editar">
                                        <i class="fas fa-edit"></i>
                                    </a>

                                    <a onclick="Confirmar1({{$cargo->idcargo}},'{{$cargo->verificar}}')" 
                                        class="btn btn-dark mtmobile" style="color:#fff" title="Eliminar">
                                        <i class="fas fa-trash"></i>
                                    </a>

                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table> 
                    {{$cargos->links()}}
                </div>
            </div>
        </div>
    </div>
    @include('livewire.cargo.form')
    @include('livewire.cargo.nuevaFuncion')
    @include('livewire.cargo.nuevaFuncionEdit')
    @include('livewire.cargo.vistaFunciones')
</div>

@section('javascript')
<script>
    document.addEventListener('DOMContentLoaded', function(){

        window.livewire.on('show-modal', msg=>{
            $('#theModal').modal('show')
        });

        window.livewire.on('cargo-added', msg=>{
            $('#theModal').modal('hide')
        });

        window.livewire.on('cargo-updated', msg=>{
            $('#theModal').modal('hide')
        });

        // Formulario de nueva funcion
        window.livewire.on('show-modal-NFuncion', Msg => {
            $('#theModal-NFuncion').modal('show')
        })

        window.livewire.on('fun-added', msg=>{
            $('#theModal').modal('hide')
        });

        window.livewire.on('modal-hide-NFuncion', Msg => {
            $('#theModal-NFuncion').modal('hide')
        })
        
        // formulario de vista funciones
        window.livewire.on('show-modal-VFuncion', Msg => {
            $('#theModal-VFuncion').modal('show')
        })

        window.livewire.on('modal-hide-VFuncion', Msg => {
            $('#theModal-VFuncion').modal('hide')
        })

        // formulario editar funciones
        window.livewire.on('show-modal-EditFuncion', Msg => {
            $('#theModal-EditFuncion').modal('show')
        })

        window.livewire.on('modal-hide-EditFuncion', Msg => {
            $('#theModal-EditFuncion').modal('hide')
        })

        window.livewire.on('fun-updated', msg=>{
            $('#theModal').modal('hide')
        });

        // Eliminar funcion seleccionado
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
                text: "¿CONFIRMAS ELIMINAR  EL REGISTRO?",
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