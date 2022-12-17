<div wire:ignore.self class="modal fade" id="theModal-VFuncion" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary" style="background: #414141">
                <h5 class="modal-title text-white">
                    <b>{{$pageTitleF}}</b>
                </h5>

                {{-- @foreach($cargos as $cargo) --}}
                    <a href="javascript:void(0)" wire:click="AbrirNuevaFuncion()" 
                        class=" btn btn-info p-1" style="color: #fff">
                        {{--<i class="fas fa-plus-circle">--}} Agregar</i>
                    </a>
                {{-- @endforeach   --}}

                {{-- <h6 class="text-center text-warning" wire:loading>POR FAVOR ESPERE</h6> --}}
            </div>
            <div class="modal-body">

                <div class="widget-content">
                    <div class="table-responsive">
                        <table class="table table-bordered table-bordered-bd-ligth striped mt-1" >
                            <thead class="text-white" style="background: #ee761c">
                                <tr>
                                    {{-- <th style="width: 50%;">#</th> --}}
                                    <th style="width: 50%;">FUNCION</th>
                                    <th style="width: 2%; text-align: center;">ACTIONS</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($detalle != null)
                                    @foreach($detalle as $det)
                                        <tr>
                                            {{-- <td><h6>{{ $nro++ }}</h6></td> --}}
                                            <td><h6>{{$det->nameFuncion}}</h6></td>
            
                                            <td class="text-center">
                                                <a href="javascript:void(0)"
                                                    wire:click="EditarF({{$det->idfuncion}})"
                                                    class="btn btn-dark p-2" title="Edit">
                                                    <i class="fas fa-edit"></i>
                                                </a>

                                                <a href="javascript:void(0)"
                                                    wire:click="EliminarF('{{$det->idfuncion}}')"
                                                    class="btn btn-dark p-2" title="Destroy">
                                                    <i class="fas fa-trash"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <h4>Sin funciones</h4>
                                @endif
                                
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" wire:click.prevent="resetUI()" class="btn btn-primary"
                    data-dismiss="modal" style="background: #3b3f5c">Cerrar</button>
            </div>
        </div>
    </div>
</div>