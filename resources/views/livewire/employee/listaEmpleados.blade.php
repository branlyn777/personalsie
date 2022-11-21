{{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Empresas</title>
</head> --}}
{{-- <body>
    <div class="card">
        <div class="card-header">
            <div class="card-title">Lista de Empleados</div>
            <div class="card-title">Fecha de Creacion: {{ date('Y-m-d H:i:s') }}</div>
        </div>
        <div class="card-body">
            <table class="table table-head-bg-primary mt-4">
                <thead>
                    <tr>
                        <th style="text-align: left">#</th>
                        <th style="text-align: left">NRO DE CI</th>
                        <th style="text-align: left">NOMBRE COMPLETO</th>
                        <th style="text-align: left">FECHA DE NACIMIENTO</th>
                        <th style="text-align: left">DIRECCION</th>
                        <th style="text-align: left">TELEFONO</th>
                        <th style="text-align: left">AREA DE TRABAJO</th>
                        <th style="text-align: left">CARGO</th>
                    </tr>
                </thead> --}}
                {{-- <tbody>
                    @foreach ($empleados as $emp)
                        <tr>
                            <th scope="row">Num </th>
                            <td style="text-align: left">{{$emp->ci}}</td>
                            <td style="text-align: left">{{$emp->name}} {{$emp->lastname}}</td>
                            <td style="text-align: left">{{$emp->dateNac}}</td>
                            <td style="text-align: left">{{$emp->address}}</td>
                            <td style="text-align: left">{{$emp->phone}}</td>
                            <td style="text-align: left">{{$emp->area}}</td>
                            <td style="text-align: left">{{$emp->cargo}}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</body>
</html> --}}

<div class="row sales layout-top-spacing">
    <div class="col-sm-12">
        <div class="widget widget-chart-one">
            <div class="widget-heading">
                <h3 style="text-align: center">Lista de Empleados</h3>
                <h4 style="text-align: center">Fecha de Creacion: {{date('Y-m-d')}}</h4>
            </div>

            <div class="widget-content">
                <div class="table-responsive">
                    <table class="table table-bordered table-bordered-bd-success striped mt-2">
                        <thead class="text-white" style="background: #ee761c">
                            <tr>
                                <th style="text-align: left">#</th>
                                <th style="text-align: left">NRO DE CI</th>
                                <th style="text-align: left">NOMBRE COMPLETO</th>
                                <th style="text-align: left">FECHA DE NACIMIENTO</th>
                                <th style="text-align: left">DIRECCION</th>
                                <th style="text-align: left">TELEFONO</th>
                                <th style="text-align: left">AREA DE TRABAJO</th>
                                <th style="text-align: left">CARGO</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($empleados as $emp)
                                <tr>
                                    <th scope="row">Num</th>
                                    <td style="text-align: left">{{$emp->ci}}</td>
                                    <td style="text-align: left">{{$emp->name}}</td>
                                    <td style="text-align: left">{{$emp->dateNac}}</td>
                                    <td style="text-align: left">{{$emp->address}}</td>
                                    <td style="text-align: left">{{$emp->phone}}</td>
                                    <td style="text-align: left">{{$emp->area}}</td>
                                    <td style="text-align: left">{{$emp->cargo}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>