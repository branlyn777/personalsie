@section('css')
    <style>
        .modal .modal-content { width: 100%; }
    </style>
@endsection

<div>
    <div class="row">
        <div class="col-12 text-center" style="margin-bottom: 50px">
            <p class="h1"><b>{{$componentName}} | {{$pageTitle}}</b></p>
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
                <input type="text" wire:model="search" placeholder="Empleado" class="form-control">
            </div>
        </div>
    
        <div class="col-12 col-sm-6 col-md-4 text-center"></div>

        <div class="col-12 col-sm-12 col-md-4 text-right">
            <a href="javascript:void(0)" class=" btn btn-primary" style="color: #fff" data-toggle="modal"
                data-target="#theModal"">Agregar</a>
        </div>

    </div>
    <br>
    <div class="table-5">
        <table>
            <thead> 
                <tr class="text-center">
                    <th class="table-th text-white">#</th>
                    <th class="table-th text-white">EMPLEADO</th>
                    <th class="table-th text-white text-center">USUSRIO</th>
                    <th class="table-th text-white text-center">ACTIONS</th>        
                </tr>
            </thead>
            <tbody>
                @foreach($datos as $dat)
                <tr>
                    <td><h6>{{ ($datos->currentpage()-1) * $datos->perpage() + $loop->index + 1 }}</h6></td>
                    <td><h6>{{$dat->name}}</h6></td>
                    <td><h6 class="text-center">{{$dat->email}}</h6></td>

                    <td class="text-center">
                        <a href="javascript:void(0)"
                        wire:click="Edit({{$dat->idUserEmploy}})"
                        class="btn btn-dark mtmobile" title="Edit">
                        <i class="fas fa-edit"></i>
                        </a>

                        <a href="javascript:void(0)"
                            onclick="Confirm({{$dat->idUserEmploy}},'{{$dat->verificar}}')"
                            class="btn btn-dark mtmobile" title="Destroy">
                            <i class="fas fa-trash"></i>
                        </a>
                    </td>
                </tr>
                @endforeach        
            </tbody>
        </table>
        {{$datos->links()}}
    </div>
    @include('livewire.userEmployee.form')
</div>

@section('javascript')
<script>
    document.addEventListener('DOMContentLoaded', function(){
        // Eventos crud
        window.livewire.on('usuem-added', msg=>{
            $('#theModal').modal('hide')
        });
        window.livewire.on('usuem-updated', msg=>{
            $('#theModal').modal('hide')
        });
        window.livewire.on('usuem-deleted', msg=>{
            // mostrar notificacion de que el producto se a eliminado
        });
        window.livewire.on('show-modal', msg=>{
            $('#theModal').modal('show')
        });
        window.livewire.on('modal-hide', msg=>{
            $('#theModal').modal('hide')
        });
        window.livewire.on('hidden.bs.modal', msg=>{
            $('.er').css('display','none')
        });
    });

    function Confirm(id, verificar){
        if(verificar == 'si')
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
        else
        {
            Swal(
                'Error',
                'No es posible eliminar porque tiene datos relacionados.',
                'error'
            )
            return;
        }
        
    }
</script>
<!-- Scripts para el mensaje de confirmacion arriba a la derecha Categoría Creada con Éxito y Alerta de Eliminacion -->
<script src="{{ asset('plugins/sweetalerts/sweetalert2.min.js') }}"></script>
<script src="{{ asset('plugins/sweetalerts/custom-sweetalert.js') }}"></script>
<!-- Fin Scripts -->
@endsection
