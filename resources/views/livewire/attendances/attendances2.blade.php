<div>
    <div class="row">
        <div class="col-12 text-center">
            <p class="h1"><b>REPORTE DE ENTRADAS Y SALIDAS</b></p>
        </div>
    </div>
        
        <div class="row">
    
            <div class="col-12 col-sm-3 col-md-3 ">
                <h6>Elige el Empleado</h6>
                <div class="form-group">
                    <select wire:model="userId" class="form-control">
                        <option value="0">Todos</option>
                        @foreach($lista_asistencias as $employee)
                            <option value="{{$employee->id}}">{{$employee->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
    

            <div class="col-12 col-sm-3 col-md-3">
                
                    <h6>Fecha Desde</h6>
                    <div class="form-group" >
                         <input @if ($reportType != 1)   @endif type="date" wire:model="dateFrom"
                            class="form-control flatpickr" placeholder="Click para elegir"> 
                    </div>
                
            </div>
    

            <div class="col-12 col-sm-3 col-md-3">
               
                            <h6>Fecha Hasta</h6>
                            <div class="form-group">
                                <input @if ($reportType != 1)  @endif type="date" wire:model="dateTo"
                                    class="form-control flatpickr" placeholder="Click para elegir"> 
                            </div>
                
            </div>

            <div class="col-12 col-sm-3 col-md-3">
                <h2 style = "visibility: hidden">A</h2>
                
                    {{-- <a class="btn btn-primary {{count($lista_asistencias) < 1? 'disabled' : ''}}"
                    href="{{ url('report/excel' . '/' . $userId . '/' . $reportType. '/' . $dateFrom. '/' . $dateTo) }}"
                    target="_blank">Exportar a Excel Salarios</a> --}}

            </div>
        </div>

        <div class="widget-content">
            <div class="row">

                <div class="col-sm-5 mt-2" >
                    <div class="card-body">
                        @if (isset($errors) && $errors->any())
                        <div class="alert alert-danger" role="alert">
                            @foreach ($errors->all() as $error)
                            {{$error}}
                            @endforeach
                        </div>
                        @endif

                        <form action="{{url('POST')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="file" name="import_file" wire:change="archivo">
                            @if($verfiarchivo!=null)
                            <button type="submit" class="btn btn-primary" >
                                IMPORTAR EXCEL
                            </button>
                            @endif
                        </form>
                    </div>
                 </div>
            </div>

            <div class="col-sm-2 mt-4">
                <a class="btn btn-danger" style="color: white" data-toggle="modal"
                data-target="#theModal"
                target="_blank">Asistencia Por Fallo Biometrico</a>

            </div> <br>

            </div>          
        </div>

        <div class="table-5">
            <table>
                <thead> 
                    <tr class="text-center">
                        <th>N°</th>
                        <th>Dia</th>
                        <th>FECHA</th>
                        <th>ENTREDA</th>
                        <th>SALIDA</th>
                        <th>NOMBRE</th>
                        <th>RETRASO</th>
                        <th>SALIDA</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($lista_asistencias as $a)
                    <tr>
                        <td class="text-center">
                            {{$loop->iteration}}
                        </td>
                        <td class="text-center">
                            {{ ($a->dia) }}
                        </td>
                        <td class="text-center">
                            {{ Carbon\Carbon::parse($a->fecha_asistencia)->format('d/m/Y') }}
                        </td>
                        <td class="text-center">                          
                            {{ Carbon\Carbon::parse($a->entrada_asistencia)->format(' H:i') }}
                        </td>
                        <td class="text-center">                          
                            {{ Carbon\Carbon::parse($a->salida_asistencia)->format(' H:i') }}
                        </td>
                        <td class="text-center">
                            {{ ($a->nombreemployees) }}
                        </td>
                        <td class="text-center">
                            {{ Carbon\Carbon::parse($a->retraso)->format(' i:s:H') }}
                        </td>
                        <td class="text-center">
                            {{$a->Salida_Normal}}
                               
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
          {{--   {{ $lista_asistencias->links() }} --}}
        </div>
        @include('livewire.attendances.form_fallo2')
</div>

<script>
    document.addEventListener('DOMContentLoaded', function(){
 
         window.livewire.on('show-modal', msg=>{
             $('#theModal').modal('show')
         });
         window.livewire.on('modal-hide', msg=>{
             $('#theModal').modal('hide')
         });
         window.livewire.on('asist-fallo', Msg => {
             //llamar a la funcion del backend
             $('#theModal').modal('hide')
         })
         window.livewire.on('importe-rechazado', Msg => {
             noty(Msg)
         })
 
     });
 </script>
