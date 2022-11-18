<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Lista de Empleados</title>
    <link rel="stylesheet" href="{{ asset('css/custom_pdf.css')}}">
    <link rel="stylesheet" href="{{ asset('css/custom_page.css')}}">
</head>
<body>
    <section class="header" style="top: -287px;">
        <table cellpadding="0" cellspacing="0" width="100%">
            <tr>
                <td colspan="2" class="text-center">
                    <span style="font-size: 25px; font-weight: bold;">Prueba de Exportacion</span>
                </td>
            </tr>

            <tr>
                <td width="20%" style="vertical-align: top; padding-top: 10px; position: relative">
                    <img src="{{ asset('assets/img/logo.png') }}" class="invoice-logo">
                </td>
                <td width="70%" class="text-left text-company" style="vertical-align: top; padding-top: 10px">
                    
                    <span style="font-size: 16px"><strong>Lista de Empleados</strong></span>
                    {{--<br>
                     <span style="font-size: 16px"><strong>Del: {{$fromDate}} al {{$toDate}}</strong></span>
                    <br>
                    <span style="font-size: 16px"><strong>Fecha de consulta: {{ \Carbon\Carbon::now()->format('d-M-Y')}}</strong></span>
                    <br>
                    <span style="font-size: 14px">Usuario: {{$user}}</span> --}}
                </td>
            </tr>
        </table>
    </section>

    <section style="margin-top: -110px; margin-left: 100px">
        <table cellpadding="0" cellspacing="0" class="table-items" width="100%">
            <thead>
                <tr>
                    <th width="20%">#</th>
                    <th width="20%">CI</th>
                    <th width="15%">NOMBRE</th>
                    <th width="10%">APELLIDO</th>
                    <th width="40%">GENERO</th>
                    <th width="40%">FECHA DE NACIMIENTO</th>
                    <th width="40%">DIRECCION</th>
                    <th width="40%">TELEFONO</th>
                    <th width="40%">ESTADO CIVIL</th>
                    <th width="40%">AREA DE TRABAJO</th>
                    <th width="40%">CARGO</th>
                    <th width="40%">ESTADO</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $item)
                    <tr>
                        <td align="center">{{($data->currentpage()-1) * $data->perpage() + $loop->index + 1}}</td>
                        <td align="center">{{$item->ci}}</td>
                        <td align="center">{{$item->name}}</td>
                        <td align="center">{{$item->lastname}}</td>
                        <td align="center">{{$item->genero}}</td>
                        <td align="center">{{$item->dateNac}}</td>
                        <td align="center">{{$item->address}}</td>
                        <td align="center">{{$item->phone}}</td>
                        <td align="center">{{$item->estadoCivil}}</td>
                        <td align="center">{{$item->area_trabajo_id}}</td>
                        <td align="center">{{$item->cargo_id}}</td>
                        <td align="center">{{$item->estado}}</td>
                        <td align="center">{{$item->created_at}}</td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td class="text-center">
                        <span><b>TOTAL DE EMPLEADOS</b></span>
                    </td>

                    <td colspan="1" class="text-center">
                        <span><strong>${{number_format($data->sum('total'),2)}}</strong></span>
                    </td>

                    <td class="text-center">
                        {{$data->sum('items')}}
                    </td>

                    <td colspan="3"></td>
                </tr>
            </tfoot>
        </table>
    </section>

    <section class="footer">
        <table cellpadding="0" cellspacing="0" class="table-items" width="100%">
            <tr>
                <td width="20%">
                    <span>Sistema LWPOS v1</span>
                </td>
                <td width="60%" class="text-center">
                    <span>luisfax.com</span>
                </td>
                <td class="text-center">
                    Pagina <span class="pagenum"></span>
                </td>
            </tr>
        </table>
    </section>
</body>
</html>