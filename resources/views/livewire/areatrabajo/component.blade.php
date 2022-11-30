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
                <input type="text" wire:model="search" placeholder="Area" class="form-control">
            </div>
        </div>
    
        <div class="col-12 col-sm-6 col-md-4 text-center"></div>

        <div class="col-12 col-sm-12 col-md-4 text-right">
            <a href="javascript:void(0)" class=" btn btn-primary" style="color: #fff" data-toggle="modal"
                data-target="#theModal"">Agregar</a>
                
            <select wire:model='selected' style="color:black; border-color: blue; text-align: left; background: #fff" class="btn col-lg-4 col-4">
                <option value="Todos">Todos</option>
                <option value="Activo">Activo</option>
                <option value="Inactivo">Inactivo</option>
            </select>
        </div>

    </div>
    <br>
    <div class="table-5">
        <table>
            <thead> 
                <tr class="text-center">
                    <th style="width: 50px;">#</th>
                    <th>NOMBRE</th>
                    <th>DESCRIPCION</th>
                    <th style="width: 120px;">ESTADO</th>
                    <th style="width: 180px;">ACTIONS</th>
                </tr>
            </thead>
            <tbody>
                @foreach($areas as $area)
                <tr class="text-center">
                    <td><h6>{{ ($areas->currentpage()-1) * $areas->perpage() + $loop->index + 1 }}</h6></td>
                    <td><h6>{{$area->name}}</h6></td>
                    <td><h6>{{$area->description}}</h6></td>

                    <td>
                        <span class="badge {{$area->estadoA == 'Activo' ? 'badge-success' : 'badge-danger'}} 
                            text-uppercase"> {{$area->estadoA}}
                        </span>
                    </td>

                    <td>
                        <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                            <a href="javascript:void(0)"
                                wire:click="Edit({{$area->idarea}})"
                                class="btn btn-dark" title="Edit">
                                <i class="fas fa-edit"></i>
                            </a>
                            
                            <a onclick="Confirmar1({{$area->idarea}},'{{$area->verificar}}')" 
                                class="btn btn-dark" style="color:#fff" title="Destroy">
                                <i class="fas fa-trash"></i>
                            </a>
                        </div>
                    </td>
                </tr>
                @endforeach    
            </tbody>
        </table>
        {{$areas->links()}}
    </div>
    @include('livewire.areatrabajo.form')
</div>

@section('javascript')
<script>
    document.addEventListener('DOMContentLoaded', function(){

        window.livewire.on('show-modal', msg=>{
            $('#theModal').modal('show')
        });

        window.livewire.on('area-added', msg=>{
            $('#theModal').modal('hide')
        });

        window.livewire.on('area-updated', msg=>{
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