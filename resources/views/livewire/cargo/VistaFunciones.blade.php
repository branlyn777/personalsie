<div wire:ignore.self class="modal fade" id="theModal-Vfuncion" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-dark">
              <h5 class="modal-title text-white">
                  <b>Lista de Funciones</b>
              </h5>
              <h6 class="text-center text-warning" wire:loading>POR FAVOR ESPERE</h6>
            </div>
            <div class="modal-body">

                
                    <div class="widget-content">
                        <div class="table-responsive">
                            <table class="table table-bordered table-bordered-bd-light striped mt-1" >
                                <thead class="text-white" style="background: #02b1ce">
                                    <tr>
                                       <th class="table-th text-white">FUNCION</th>
                                       <th class="table-th text-white text-center">ACTIONS</th>
                                    </tr>
                                </thead>
                                <tbody> --}}
                                     {{-- @foreach($funciones as $funcion)
                                    <tr>
                                        <td><h6>{{$funcion->funcionDeCargo}}</h6></td>
        
                                        <td class="text-center">
                                            <a href="javascript:void(0)"
                                                wire:click="Edit({{$funcion->idFuncion}})"
                                                class="btn btn-dark mtmobile" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            
                                            <a href="javascript:void(0)"
                                                onclick="Confirmar1('{{$funcion->idFuncion}}','{{$funcion->verificar}}')"
                                                class="btn btn-dark mtmobile" title="Destroy">
                                                <i class="fas fa-trash"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach --}}
                                </tbody>
                            </table>
                            {{--$funciones->links()--}}
                        </div>
                    </div>
                

            </div>
            <div class="modal-footer">

                <button type="button" wire:click.prevent="resetUI()" class="btn btn-warning close-btn text-info"
                    data-dismiss="modal" style="background: #3b3f5c">CERRAR</button>
                
            </div>
        </div>
    </div>
</div>