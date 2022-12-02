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
                <input type="text" wire:model="search" placeholder="Nombre de Empleado" class="form-control">
            </div>
        </div>
    
        <div class="col-12 col-sm-6 col-md-4 text-center"></div>

        <div class="col-12 col-sm-12 col-md-4 text-right">
            <a href="javascript:void(0)" class=" btn btn-primary" style="color: #fff" data-toggle="modal"
                data-target="#theModal"">Agregar</a>

            {{-- <select wire:model='selected' style="color:black; border-color: blue; text-align: left; background: #fff" class="btn col-lg-4 col-4">
                <option value="Todos">Todos</option>
                <option value="Permiso">Permiso</option>
                <option value="Licencia">Licencia</option>
            </select> --}}
        </div>

    </div>
    <br>
    <div class="table-5">
        <table>
            <thead> 
                <tr class="text-center">
                    <th style="width: 50px;">#</th>
                    <th style="width: 250px;">EMPLEADO</th>
                    <th style="width: 150px;">FECHA</th>
                    <th>MOTIVO</th>
                    <th style="width: 180px;">COMPROVANTE</th>
                    {{-- <th style="width: 120px;">ESTADO</th> --}}
                    <th style="width: 120px;">ACTIONS</th>        
                </tr>
            </thead>
            <tbody>
                @foreach($asistencias as $a)
                <tr class="text-center">
                    <td><h6>{{ ($asistencias->currentpage()-1) * $asistencias->perpage() + $loop->index + 1 }}</h6></td>
                    <td><h6>{{ $a->empleado }}</h6></td>
                    <td><h6>{{$a->fecha}}</h6></td>
                    <td><h6>{{$a->motivo}}</h6></td>
                    
                    <td>
                        <span>
                            <img src="{{ asset('storage/assistances/' .$a->comprobante)}}"
                             alt="Sin Comprobante" height="70" width="80" class="rounded"
                             wire:click="verImagen({{$a->idAsistencia}})">
                        </span>
                    </td>
                    
                    {{-- <td>
                        <span class="badge {{$a->estadoA == 'Permiso' ? 'badge-success' : 'badge-info'}} 
                            text-uppercase"> {{$a->estadoA}}
                        </span>
                    </td> --}}

                    <td>
                        <a href="javascript:void(0)"
                        wire:click="Edit({{$a->idAsistencia}})"
                        class="btn btn-dark mtmobile" title="Edit">
                        <i class="fas fa-edit"></i>
                        </a>

                        {{-- <a href="javascript:void(0)"
                            onclick="Confirm({{$a->idAsistencia}},'{{$a->verificar}}')"
                            class="btn btn-dark mtmobile" title="Destroy">
                            <i class="fas fa-trash"></i>
                        </a> --}}
                    </td>
                </tr>
                @endforeach        
            </tbody>
        </table>
        {{$asistencias->links()}}
    </div>
    @include('livewire.assistances.form')
    @include('livewire.assistances.verImg')
</div>

@section('javascript')
<script>
    document.addEventListener('DOMContentLoaded', function(){
        // Eventos
        window.livewire.on('asist-added', msg=>{
            $('#theModal').modal('hide')
        });
        window.livewire.on('asist-updated', msg=>{
            $('#theModal').modal('hide')
        });
        window.livewire.on('asist-deleted', msg=>{
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
        // vista de comprobante
        window.livewire.on('show-modal-img', msg=>{
            $('#theModal-img').modal('show')
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
