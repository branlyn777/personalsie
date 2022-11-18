{{-- <!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Contrato</title>
    <link rel="stylesheet" href="{{ asset('css/custom_pdf.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom_page.css') }}">
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="{{ asset('bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/plugins.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/structure.css') }}" rel="stylesheet" type="text/css" class="structure" />
    <!-- END GLOBAL MANDATORY STYLES -->
    <!-- BEGIN PAGE LEVEL CUSTOM STYLES -->
    <link href="{{ asset('assets/css/scrollspyNav.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/forms/theme-checkbox-radio.css') }}">
    <link href="{{ asset('assets/css/tables/table-basic.css') }}" rel="stylesheet" type="text/css" /> --}}
    <!-- END PAGE LEVEL CUSTOM STYLES -->

    {{-- <style>
        table {
        width: 100%;
        border: 1px solid rgb(255, 255, 255);
        }
        th, td {
        width: 25%;
        text-align: left;
        vertical-align: top;
        border: 1px solid rgb(255, 255, 255);
        }
    </style> --}}


{{-- </head>

<body>
    <section class="header" style="top: -287px">
        <table cellpadding="0" cellspacing="0" width="100%">
            <tr>
               
                <td style="vertical-align: top; padding-top:10px; position:relative;">
                    <img src="{{-- asset('assets/img/sie2022.jpg') --}}{{--" alt="" class="invoice-logo" height="70px">
                {{-- </td>
                <td class="text-center" colspan="2">
                    <span style="font-size: 20px; font-weight:bold;">Comprobante de Contrato</span>
                    <p style="font-size: 20px; font-weight:bold;">Soluciones Informáticas Emanuel</p>
                </td>
            </tr>
            <tr>

                <td colspan="2" style="vertical-align: top; padding-top:5px; position:relative;">
                        {{-- <span style="font-size: 16px;"><strong>COMPRA N°</strong>{{$data->id}}</span>
                        <br>
                        <span style="font-size: 16px;"><strong>Proveedor:</strong>{{$data->nombre_prov}} </span>
                        <br>     --}}
                        {{--<span style="font-size: 16px;"><strong>Fecha de Contrato:</strong>{{--$data->fecha_compra--}}{{--</span>
                    <br>

                    {{-- <span style="font-size: 14px;">Usuario: {{ $data->user_id }}</span>
                    <br> --}}
                {{--</td>
            </tr>
        </table>
    </section> --}}

    {{--<div style="margin-top:-100px;">
        <table cellpadding="0" cellspacing="0" class="table-items" width="100%">
            <thead>
                <tr>
                    <th class="table-th text-left text-dark">#</th>
                
                    <th class="table-th text-left text-dark" colspan="2">DESCRIPCION</th>
                    <th class="table-th text-left text-dark">UNIDAD</th>
                    <th class="table-th text-left text-dark">CANTIDAD</th>
                    <th class="table-th text-left text-dark">COSTO/U</th>
                  
                 
                    <th class="table-th text-left text-dark">TOTAL</th>
                   
                </tr>
            </thead>

            <tbody style="background-color: rgb(255, 255, 255)">
                {{-- @foreach ($detalle as $item)
                    <tr>
                        <td  style="padding: 0%" class="text-right">{{ $nro++ }}</td>
                       
                        <td style="padding: 0%" colspan="2">{{ $item->nombre }}</td>
                         <td style="padding: 0%" class="text-right">{{ $item->unidad}}</td>
                         <td style="padding: 0%" class="text-right">{{ $item->cantidad }}</td>
                         <td style="padding: 0%" class="text-right">{{ $item->precio }}</td>
                  
               
                         <td style="padding: 0%" class="text-right">{{ $item->precio*$item->cantidad}}</td>
                    </tr>
                @endforeach --}}
            {{--</tbody>
            <br>
    
            <tfoot>
                <tr>
                    <td class="text-center">
                        <span><b>TOTALES</b></span>
                    </td>
                    <td class="text-center" colspan="4">
                        <span><strong>Bs {{--$data->importe_total--}}{{--</strong></span>
                        <br>
                        <span><strong>$us{{--round($data->importe_total/6.96,2)--}}{{--</strong></span>
                    </td>
                  
                    <td colspan="2"></td>
                </tr>
            </tfoot>
        </table>
    </section>

    <section class="footer">
        <table cellpadding="0" cellspacing="0" width="100%">
            <tr>
                <td width="20%">
                    <span>Sistema SIE</span>
                </td>
                <td width="60%" class="text-center"> sieemanuelsie@gmail.com</td>
                <td class="text-center" width="20%">
                    <span>página</span><span class="pagenum">-</span>
                </td>
            </tr>
        </table>
    </section>
</body>

</html> --}}

<div wire:ignore.self class="modal fade" id="theModal-contrato" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary" style="background: #414141">
                <h5 class="modal-title text-white">
                    <b>Vista previa de contrato</b>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h6 class="text-center text-warning" wire:loading>POR FAVOR ESPERE</h6>
            </div>
            <div class="modal-body">
    
                {{-- <div class="row"> --}}
                    {{-- <table>
                        <thead>
                            <tr class="table-th text-white text-center"><b>Logo</b><br>Soluciones Informaticas Emanuel (S.I.E.)</tr>
                            <tr></tr>
                        </thead>

                    </table> --}}
                    <h4>Logo</h4><br>
                    <div style="text-align: left">
                        <h6>Soluciones Informaticas Emanuel (S.I.E.)</h6>
                        <h6>Av. America Nro. 949</h6>
                        <h6>Entre Av. Gabriel Rene Moreno y Munchay</h6>
                    </div>

                    <div class="text-center">
                        <h6>Soluciones Informaticas Emanuel (S.I.E.)</h6>
                        <h6>Contrato dePrueba</h6>
                    </div>

                    <p class="text-center">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Ea sapiente nesciunt, ipsum et dolorem repellat neque possimus eos exercitationem quae mollitia nulla reiciendis provident veritatis doloremque ipsam tempora unde? Illum.
                    </p>
                    <br><br>
                    <p class="text-center">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Vel dolore alias quae ipsam quaerat asperiores labore officiis doloribus impedit officia consectetur at, minima est error, recusandae adipisci sed fuga! Ex!</p>
                    
                        
                {{-- </div> --}}
            </div>
    
            <div class="modal-footer">
                <button type="button" wire:click.prevent="resetUI()" class="btn btn-primary"
                    data-dismiss="modal" style="background: #3b3f5c">Imprimir</button>
            </div>
        </div>
    </div>
</div>
