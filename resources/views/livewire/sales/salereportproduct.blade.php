@section("css")

<style>
    /* Estilos para las tablas */
    .table-wrapper {
    width: 100%;/* Anchura de ejemplo */
    height: 600px;  /*Altura de ejemplo*/
    overflow: auto;
    }

    .table-wrapper table {
        border-collapse: separate;
        border-spacing: 0;
        border-left: 0.3px solid #ee761c;
        border-bottom: 0.3px solid #ee761c;
        width: 100%;
    }
    .table-wrapper table thead {
        position: sticky;
        top: 0;
        z-index: 10;
    }
    .table-wrapper table thead tr {
    background: #ee761c;
    color: white;
    }
    .table-wrapper table tbody tr:hover {
        background-color: #bbf7ffa4;
    }
    .table-wrapper table td {
        border-top: 0.3px solid #ee761c;
        padding-left: 10px;
        border-right: 0.3px solid #ee761c;
    }
</style>

@endsection
<div>

    <div class="row">
        <div class="col-12 text-center">
            <p class="h1"><b>REPORTE DE VENTAS POR PRODUCTOS</b></p>
        </div>
    </div>

    <div class="row">
        <div class="col-12 col-sm-12 col-md-3 text-center">
            <b>Buscar</b>
            <input class="form-control" type="text" placeholder="Buscar Producto...">
        </div>
        <div class="col-12 col-sm-12 col-md-3 text-center">
            <b>Usuario</b>
            <select class="form-control">
                <option value=""></option>
            </select>
        </div>
        <div class="col-12 col-sm-12 col-md-3 text-center">
            <b>Inicio</b>
            <input wire:model="dateFrom" class="form-control" type="date">
        </div>
        <div class="col-12 col-sm-12 col-md-3 text-center">
            <b>Fin</b>
            <input wire:model="dateTo" class="form-control" type="date">
        </div>
    </div>

    <br>

    <div class="table-wrapper">
        <table>
            <thead>
                <tr class="text-center">
                    <th>No</th>
                    <th>Nombre Producto</th>
                    <th>Cantidad</th>
                </tr>
            </thead>
            <tbody>
                @foreach($tabla_productos->sortByDesc('cantidad_vendida') as $t)
                <tr>
                    <td class="text-center">
                        {{ ($tabla_productos->currentpage()-1) * $tabla_productos->perpage() + $loop->index + 1 }}
                    </td>
                    <td>
                        {{$t->nombre_producto}}
                    </td>
                    <td class="text-center">
                        {{$t->cantidad_vendida}}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    {{ $tabla_productos->links() }}

</div>
