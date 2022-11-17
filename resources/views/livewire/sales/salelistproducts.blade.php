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







         /* Estilos para el loading */
    .lds-roller {
        display: inline-block;
        position: relative;
        width: 80px;
        height: 80px;
        }
        .lds-roller div {
        animation: lds-roller 1.2s cubic-bezier(0.5, 0, 0.5, 1) infinite;
        transform-origin: 40px 40px;
        }
        .lds-roller div:after {
        content: " ";
        display: block;
        position: absolute;
        width: 7px;
        height: 7px;
        border-radius: 50%;
        background: #ee761c;
        margin: -4px 0 0 -4px;
        }
        .lds-roller div:nth-child(1) {
        animation-delay: -0.036s;
        }
        .lds-roller div:nth-child(1):after {
        top: 63px;
        left: 63px;
        }
        .lds-roller div:nth-child(2) {
        animation-delay: -0.072s;
        }
        .lds-roller div:nth-child(2):after {
        top: 68px;
        left: 56px;
        }
        .lds-roller div:nth-child(3) {
        animation-delay: -0.108s;
        }
        .lds-roller div:nth-child(3):after {
        top: 71px;
        left: 48px;
        }
        .lds-roller div:nth-child(4) {
        animation-delay: -0.144s;
        }
        .lds-roller div:nth-child(4):after {
        top: 72px;
        left: 40px;
        }
        .lds-roller div:nth-child(5) {
        animation-delay: -0.18s;
        }
        .lds-roller div:nth-child(5):after {
        top: 71px;
        left: 32px;
        }
        .lds-roller div:nth-child(6) {
        animation-delay: -0.216s;
        }
        .lds-roller div:nth-child(6):after {
        top: 68px;
        left: 24px;
        }
        .lds-roller div:nth-child(7) {
        animation-delay: -0.252s;
        }
        .lds-roller div:nth-child(7):after {
        top: 63px;
        left: 17px;
        }
        .lds-roller div:nth-child(8) {
        animation-delay: -0.288s;
        }
        .lds-roller div:nth-child(8):after {
        top: 56px;
        left: 12px;
        }
        @keyframes lds-roller {
        0% {
            transform: rotate(0deg);
        }
        100% {
            transform: rotate(360deg);
        }
    }



        .boton-azul {
			text-decoration: none !important; 
			background-color: #4894ef;
			cursor: pointer;
			color: white;
			border-color: #4894ef;
			border-radius: 7px;
			padding-top: 2px;
			padding-bottom: 2px;
			padding-left: 5px;
			padding-right: 5px;
			box-shadow: none;
			border-width: 2px;
			border-style: solid;
			display: inline-block;
		}
		.boton-azul:hover {
			background-color: rgb(255, 255, 255);
			color: #4894ef;
			transition: all 0.4s ease-out;
			border-color: #4894ef;
			text-decoration: underline;
			-webkit-transform: scale(1.05);
			-moz-transform: scale(1.05);
			-ms-transform: scale(1.05);
			transform: scale(1.05);
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
        <div class="col-12 col-sm-6 col-md-2 text-center">
            <b>Buscar</b>
            <div class="form-group">
                <input wire:model="search" type="text" class="form-control" placeholder="Ingrese Nombre o código">
            </div>
        </div>
        <div class="col-12 col-sm-6 col-md-2 text-center">
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
        <div class="col-12 col-sm-6 col-md-2 text-center">
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
        <div class="col-12 col-sm-6 col-md-2 text-center">
            <b>Categoria</b>
            <div class="form-group">
                <select wire:model="categoria_id" class="form-control">
                    <option value="Todos" selected>Todos</option>
                    @foreach ($this->lista_categoria as $c)
                        <option value="{{ $c->id }}">{{ ucwords(strtolower($c->name)) }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-md-2 text-center">
            <b>Fecha Inicio</b>
            <div class="form-group">
                <input type="date" wire:model="dateFrom" class="form-control" >
            </div>
        </div>

        <div class="col-12 col-sm-6 col-md-2 text-center">
            <b>Fecha Fin</b>
            <div class="form-group">
                <input type="date" wire:model="dateTo" class="form-control" >
            </div>
        </div>
    </div>



    <div class="row">
        <div class="col-12 col-sm-6 col-md-6 text-center">
            <b>Total Utilidad</b>
            <div class="form-group">
                <div class="">
                    <p class="h2"><b>{{ number_format($this->total_utilidad, 2, ",", ".")}} Bs</b></p>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-md-6 text-center">
            <b>Total Precio</b>
            <div class="form-group">
                <div class="">
                    <p class="h2"><b>{{ number_format($this->total_precio, 2, ",", ".")}} Bs</b></p>
                </div>
            </div>
        </div>
    </div>

    <center><div id="preloader_3" wire:loading.delay.longest>
                
            
        <div class="lds-roller"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>

    
    </div></center>



    <div class="table-1">
        <table>
            <thead>
                <tr class="text-center">
                    <th>Codigo</th>
                    <th>Producto</th>
                    <th>Código Producto</th>
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
                        <span class="stamp stamp" style="background-color: #ee761c">
                            {{$l->codigo}}
                        </span>
                    </td>
                    <td>
                        {{$l->nombre_producto}}
                    </td>
                    <td class="text-center">
                        {{$l->codigo_producto}}
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
                        @if($l->ventareciente > -1)
                            @if($l->ventareciente == 1)
                            <div style="color: rgb(0, 201, 33);">
                                <b>Hace {{$l->ventareciente}} Minuto</b>
                            </div>
                            @else
                            <div style="color: rgb(0, 201, 33);">
                                <b>Hace {{$l->ventareciente}} Minutos</b>
                            </div>
                            @endif
                        @endif
                        {{ \Carbon\Carbon::parse($l->fecha_creacion)->format('d/m/Y H:i') }}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {{ $listaproductos->links() }}
    </div>
    

</div>
