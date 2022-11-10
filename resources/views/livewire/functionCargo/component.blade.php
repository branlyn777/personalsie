<div class="row sales layout-top-spacing">
    <div class="col-sm-12">
        <div class="widget widget-chart-one">
            <div class="widget-heading">
                <h4 class="card-title">
                    <b>{{$componentName}} | {{$pageTitle}}</b>
                </h4>
                <ul class="tabs tab-pills">
                    <a href="javascript:void(0)" class="btn btn-warning" data-toggle="modal"
                    data-target="#theModal">Agregar</a>
                </ul>
            </div>

            @include('common.searchbox')

            <div class="widget-content">
                <div class="table-responsive">
                    <table class="table table-bordered table-bordered-bd-warning striped mt-1" >
                        <thead class="text-white" style="background: #02b1ce">
                            <tr>
                               <th class="table-th text-white">FUNCION</th>
                               <th class="table-th text-white text-center">ACTIONS</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($funciones as $funcion)
                            <tr>
                                <td><h6>{{$funcion->funcionDeCargo}}</h6></td>

                                <td class="text-center">
                                    <a href="javascript:void(0)"
                                        wire:click="Edit({{$funcion->idFuncion}})"
                                        class="btn btn-dark mtmobile" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    
                                    <a href="javascript:void(0)"
                                        onclick="Confirmar1('{{$funcion->idFuncion}}','{{$funcion->verificar}}')"
                                        class="btn btn-dark mtmobile" title="Destroy">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{$funciones->links()}}
                </div>
            </div>
        </div>
    </div>
    @include('livewire.functionCargo.form')
</div>

@section('javascript')
<script>
    document.addEventListener('DOMContentLoaded', function(){
    
        window.livewire.on('show-modal', msg=>{
            $('#theModal').modal('show')
        });

        window.livewire.on('fun-added', msg=>{
            $('#theModal').modal('hide')
        });

        window.livewire.on('fun-updated', msg=>{
            $('#theModal').modal('hide')
        });
    });

    function Confirmar1(id, verificar)
    {
        if(verificar == 'no')
        {
            swal('no es posible eliminar porque tiene datos relacionados')
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