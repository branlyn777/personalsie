<div wire:ignore.self class="modal fade" id="theModal-Nfuncion" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary" style="background: #414141">
                <h5 class="modal-title text-white">
                    <b>Nueva funcion</b>
                </h5>
                <h6 class="text-center text-warning" wire:loading>POR FAVOR ESPERE</h6>
            </div>
            <div class="modal-body">

                <div class="row">

                    <div class="col-sm-12 col-md-6">
                        <div class="form-group">
                            <label>Cargo</label>
                            <select wire:model="cargoid" class="form-control">
                                <option value="Elegir" disabled>Elegir</option>
                                @foreach($cargosx as $cs)
                                    <option value="{{$cs->id}}">{{$cs->name}}</option>
                                @endforeach
                            </select>
                            @error('cargoid') <span class="text-danger er"> {{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="col-sm-12 col-md-6">
                        <div class="form-group">
                            <h6>Funcion</h6>
                            <textarea type="text" wire:model.lazy="nameFuncion" class="form-control"></textarea>
                            @error('nameFuncion')<span class="text-danger er">{{ $message }}</span>@enderror
                        </div>
                    </div>

                </div>

            </div>
            <div class="modal-footer">
                <button type="button" wire:click.prevent="resetUI()" class="btn btn-warning"
                    data-dismiss="modal" style="background: #3b3f5c">Cancelar</button>
                
                <button type="button" wire:click.prevent="Store_NFuncion()"
                    class="btn btn-warning">Guardar</button>
                
            </div>
        </div>
    </div>
</div>