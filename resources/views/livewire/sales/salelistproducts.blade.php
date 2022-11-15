@section('css')
    <style>
        /* Tabla */
		.table-1 {
		width: 100%;/* Anchura de ejemplo */
		height: 2000px;  /*Altura de ejemplo*/
		overflow: auto;
		}
		.table-1 table {
			border-collapse: separate;
			border-spacing: 0;
			border-left: 0.1px solid #ee761c;
			border-bottom: 0.1px solid #ee761c;
			width: 100%;
		}
		.table-1 table thead {
			position: sticky;
			top: 0;
			z-index: 10;
		}
		.table-1 table thead tr {
		background: #ee761c;
		color: white;
		}
		.table-1 table tbody tr:hover {
			background-color: #fceb8ea4;
		}
		.table-1 table td {
			border-top: 0.1px solid #ee761c;
			padding-left: 8px;
			padding-right: 8px;
			border-right: 0.1px solid #ee761c;
		}
    </style>
@endsection
<div>
    <div class="row">
        <div class="col-12 col-sm-12 col-md-12 text-center">
            <p class="h1"><b>PRODUCTOS VENDIDOS</b></p>
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-sm-6 col-md-3 text-center">
            <b>Seleccionar Sucursal</b>
            <div class="form-group">
                <select wire:model="sucursal_id" class="form-control">
                    @foreach($listasucursales as $sucursal)
                    <option value="{{$sucursal->id}}">{{$sucursal->name}}</option>
                    @endforeach
                    <option value="Todos">Todas las Sucursales</option>
                </select>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-md-3 text-center">
            <b>Seleccionar Usuario</b>
            <div class="form-group">
                <select wire:model="user_id" class="form-control">
                    <option value="Todos" selected>Todos</option>
                    @foreach ($listausuarios as $u)
                        <option value="{{ $u->id }}">{{ ucwords(strtolower($u->name)) }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-md-3 text-center">
            <b>Fecha Inicio</b>
            <div class="form-group">
                <input type="date" wire:model="dateFrom" class="form-control" >
            </div>
        </div>

        <div class="col-12 col-sm-6 col-md-3 text-center">
            <b>Fecha Fin</b>
            <div class="form-group">
                <input type="date" wire:model="dateTo" class="form-control" >
            </div>
        </div>
    </div>

    <div class="table-1">
        <table>
            <thead>
                <tr class="text-center">
                    <th>No</th>
                    <th>Codigo</th>
                    <th>Producto</th>
                    <th>Cantidad</th>
                    <th>Precio</th>
                    <th>Usuario</th>
                    <th>Sucursal</th>
                    <th>Fecha</th>
                </tr>
            </thead>
            <tbody>
                @foreach($listaproductos as $l)
                <tr>
                    <td class="text-center">

                    </td>
                    <td class="text-center">
                        <span class="stamp stamp" style="background-color: #ee761c">
                            {{$l->codigo}}
                        </span>
                    </td>
                    <td>
                        {{$l->nombre_producto}}
                    </td>
                    <td class="text-center">
                        {{$l->cantidad_vendida}}
                    </td>
                    <td class="text-right">
                        {{$l->precio_venta}}
                    </td>
                    <td class="text-center">
                        {{$l->nombre_vendedor}}
                    </td>
                    <td class="text-center">
                        {{$l->nombresucursal}}
                    </td>
                    <td class="text-center">
                        {{ \Carbon\Carbon::parse($l->fecha_creacion)->format('d/m/Y H:i') }}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</div>
