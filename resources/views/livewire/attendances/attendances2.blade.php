<div>
    <div class="row">
        <div class="col-12 text-center">
            <p class="h1"><b>REPORTE DE ENTRADAS Y SALIDAS</b></p>
        </div>
    </div>
        
        {{-- <div class="row">
    
            <div class="col-12 col-sm-6 col-md-4">
                <h6>Elige el Empleado</h6>
                <div class="form-group">
                    <select wire:model="userId" class="form-control">
                        <option value="0">Todos</option>
                        @foreach($employees as $employee)
                            <option value="{{$employee->id}}">{{$employee->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
    

            <div class="col-12 col-sm-6 col-md-4 text-center">
                <div class="col-sm-3">
                    <h6>Fecha Desde</h6>
                    <div class="form-group" >
                         <input @if ($reportType != 1)   @endif type="date" wire:model="dateFrom"
                            class="form-control flatpickr" placeholder="Click para elegir"> 
                    </div>
                </div>
            </div>
    

            <div class="col-12 col-sm-12 col-md-4 text-right">
                <div class="col-sm-3 ">
                            <h6>Fecha Hasta</h6>
                            <div class="form-group">
                                <input @if ($reportType != 1)  @endif type="date" wire:model="dateTo"
                                    class="form-control flatpickr" placeholder="Click para elegir"> 
                            </div>
                        </div>
            </div>


            <div class="col-12 col-sm-12 col-md-4 text-right">
                <div class="col-sm-3">
                    <h2 style = "visibility: hidden">A</h2>

                </div>
            </div>
        </div> --}}

  


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
                            {{-- {{ date("d/m/Y", strtotime($a->fecha)) }} --}}
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
                            {{ ($a->retraso) }}
                        </td>

                        
                    </tr>
                    @endforeach
                </tbody>
            </table>
          {{--   {{ $lista_asistencias->links() }} --}}
        </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function(){
 
         window.livewire.on('show-modal', msg=>{
             $('#theModal').modal('show')
         });
 
     });
 </script>
