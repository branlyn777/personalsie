<div>
    <div class="row">
        <div class="col-12 text-center">
            <p class="h1"><b>REPORTE DE ENTRADAS Y SALIDAS</b></p>
        </div>

        <div class="row">
    
            <div class="col-12 col-sm-6 col-md-4">
                <h6>Elige el Empleado</h6>
                <div class="form-group">
                    <select wire:model="userId" class="form-control">
                        <option value="0">Todos</option>
                        {{-- @foreach($employees as $employee)
                            <option value="{{$employee->id}}">{{$employee->name}}</option>
                        @endforeach --}}
                    </select>
                </div>
            </div>
    

            <div class="col-12 col-sm-6 col-md-4 text-center">
                <div class="col-sm-3">
                    <h6>Fecha Desde</h6>
                    <div class="form-group" >
                        {{-- <input @if ($reportType != 1) {{-- disabled --}}  @endif type="date" wire:model="dateFrom"
                            class="form-control flatpickr" placeholder="Click para elegir"> --}}
                    </div>
                </div>
            </div>
    

            <div class="col-12 col-sm-12 col-md-4 text-right">
                <div class="col-sm-3 ">
                            <h6>Fecha Hasta</h6>
                            <div class="form-group">
                               {{--  <input @if ($reportType != 1)  {{-- disabled --}} @endif type="date" wire:model="dateTo"
                                    class="form-control flatpickr" placeholder="Click para elegir"> --}}
                            </div>
                        </div>
            </div>


            <div class="col-12 col-sm-12 col-md-4 text-right">
                <div class="col-sm-3">
                    <h2 style = "visibility: hidden">A</h2>
                    
                      {{--   <a class="btn btn-primary {{count($data) < 1? 'disabled' : ''}}"
                        href="{{ url('report/excel' . '/' . $userId . '/' . $reportType. '/' . $dateFrom. '/' . $dateTo) }}"
                        target="_blank">Exportar a Excel Salarios</a> --}}

                </div>
            </div>
    
        </div>
    </div>
</div>
