<div wire:ignore.self class="modal fade" id="theModal-Vfuncion" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary" style="background: #414141">
                {{-- <h5 class="modal-title text-white">
                    <b>Lista de Funciones</b>
                </h5>
                <h6 class="text-center text-warning" wire:loading>POR FAVOR ESPERE</h6> --}}
            </div>
            <div class="modal-body">

                <div class="widget-content">
                    <div class="table-responsive">
                        <table class="table table-bordered table striped mt-1" >
                            <thead class="text-white" style="background: #02b1ce">
                                <tr>
                                    <th class="table-th text-white">Nombre de Funcion</th>
                                    <th class="table-th text-white text-center">Acciones</th> 
                                </tr>
                            </thead>
                            <tbody>
                                
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" wire:click.prevent="resetUI()" class="btn btn-warning"
                    data-dismiss="modal" style="background: #3b3f5c">Cerrar</button>
            </div>
        </div>
    </div>
</div>