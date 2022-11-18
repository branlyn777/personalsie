<div wire:ignore.self class="modal fade" id="theModal-EditFuncion" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary" style="background: #414141">
                <h5 class="modal-title text-white">
                    <b>{{$pageTitleMod}}</b>
                </h5>
                <h6 class="text-center text-warning" wire:loading>POR FAVOR ESPERE</h6>
            </div>
            <div class="modal-body">

                {{-- Actualizar ó editar Funciones --}}
                <div class="col-sm-12 col-md-6">
                    <div class="form-group">
                        <label>Cargo</label>
                        <h4>{{$name}}</h4>
                        {{-- <input type="text" wire:model.lazy="name" class="form-control" disabled> --}}
                    </div>
                </div>
                
                <div class="col-sm-12 col-md-12">
                    <div class="form-group">
                        <h6>Funcion</h6>
                        <textarea type="text" wire:model="funame" class="form-control"></textarea>
                        @error('funame')<span class="text-danger er">{{ $message }}</span>@enderror
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" wire:click.prevent="resetUI()" class="btn btn-warning"
                    data-dismiss="modal" style="background: #3b3f5c">Cancelar</button>

                <button type="button" wire:click.prevent="ActualizarFuncion()"
                    class="btn btn-warning">Actualizar</button>
            </div>
        </div>
    </div>
</div>