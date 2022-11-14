@section('css')
<style>
    .modal .modal-content { width: 80%; }
</style>
@endsection
<div>
    <div class="row">
        <div class="col-12 text-center">
            <p class="h1"><b>{{ $componentName }} | {{ $pageTitle }}</b></p>
        </div>
    </div>
    
    <div class="row">
    
        <div class="col-12 col-sm-6 col-md-4">
            @include('common.searchbox')
        </div>

        <div class="col-12 col-sm-6 col-md-4 text-center">
            
        </div>

        <div class="col-12 col-sm-12 col-md-4 text-right">
            <button wire:click="Agregar()" type="button" class="boton-azul-g">Agregar</button>
        </div>

    </div>

    <br>

    <div class="table-5">
        <table>
            <thead> 
                <tr class="text-center">
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Lunes</th>
                    <th>Martes</th>
                    <th>Miercoles</th>
                    <th>Jueves</th>
                    <th>Viernes</th>
                    <th>Sabado</th>
                    <th>Domingo</th>
                    <th>ACCIONES</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $shift)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $shift->name }}</td>
                    <td>{{ $shift->monday }}</td>
                    <td>{{ $shift->tuesday }}</td>
                    <td>{{ $shift->wednesday }}</td>
                    <td>{{ $shift->thursday }}</td>
                    <td>{{ $shift->friday }}</td>
                    <td>{{ $shift->saturday }}</td>
                    <td>{{ $shift->sunday }}</td>
    
                    <td class="text-center">
                        <a href="javascript:void(0)" wire:click="Edit({{ $shift->id }})"
                            class="btn btn-warning mtmobile" title="Editar registro">
                            <i class="fas fa-edit"></i>
                        </a>
                        <a href="javascript:void(0)"
                            onclick="Confirm('{{ $shift->id }}','{{ $shift->name }}','{{ $shift->usuarios }}')"
                            class="btn btn-warning" title="Eliminar registro">
                            <i class="fas fa-trash"></i>
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {{ $data->links() }}
    </div>
    @include('livewire.shifts.form')
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        
        window.livewire.on('item-added', Msg => {
            $('#theModal').modal('hide')
            
        })
        window.livewire.on('item-update', Msg => {
            $('#theModal').modal('hide')
            
        })
        window.livewire.on('role-deleted', Msg => {
            
        })
        window.livewire.on('item-exists', Msg => {
            
        })
        window.livewire.on('item-error', Msg => {
            
        })
        window.livewire.on('show-modal', Msg => {
            $('#theModal').modal('show')
        })
        window.livewire.on('modal-hide', Msg => {
            $('#theModal').modal('hide')
        })


    });

    function Confirm(id, name, usuarios) {
        if (usuarios > 0) {
            swal.fire({
                title: 'PRECAUCION',
                icon: 'warning',
                text: 'No se puede eliminar el Turno "' + name + '" porque hay ' +
                    usuarios + ' Empleados con ese Turno.'
            })
            return;
        }
        swal.fire({
            title: 'CONFIRMAR',
            icon: 'warning',
            text: 'Confirmar eliminar el Turno ' + '"' + name + '"',
            showCancelButton: true,
            cancelButtonText: 'Cerrar',
            cancelButtonColor: '#383838',
            confirmButtonColor: '#3B3F5C',
            confirmButtonText: 'Aceptar'
        }).then(function(result) {
            if (result.value) {
                window.livewire.emit('deleteRow', id)
                Swal.close()
            }
        })
    }
</script>