<div wire:ignore.self class="modal fade" id="theModal-rue" tabindex="-1" role="dialog" style="overflow-y: scroll;">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white">
                    <b>Usuario Empleado</b>
                </h5>
                <h6 class="text-center text-warning" wire:loading>POR FAVOR ESPERE</h6>
            </div>

            <div class="card-body">
                <div class="row">
                    <div class="col-sm-12 col-md-6">
                        <div class="form-group">
                            <label>Nombre</label>
                            <h4>{{$name}}</h4>
                            {{-- <input type="text" wire:model.lazy="nameu" class="form-control">
                            @error('nameu')<span class="text-danger er">{{ $message }}</span>@enderror --}}
                        </div>
                    </div>

                    <div class="col-sm-12 col-md-6">
                        <div class="form-group">
                            <label>idEmpleado</label>
                            <h4>{{$idEmpleado}}</h4>
                            {{-- <input type="number" wire:model.lazy="phoneu" class="form-control">
                            @error('phoneu')<span class="text-danger er">{{ $message }}</span>@enderror --}}
                        </div>
                    </div>

                    <div class="col-sm-12 col-md-6">
                        <div class="form-group">
                            <label>IdUsuario</label>
                            <h4>{{$idUsuario}}</h4>
                            {{-- <input type="number" wire:model.lazy="phoneu" class="form-control">
                            @error('phoneu')<span class="text-danger er">{{ $message }}</span>@enderror --}}
                        </div>
                    </div>

                </div>
            </div>

            <div class="modal-footer">
                <button type="button" wire:click.prevent="resetUI()" class="btn btn-primary close-btn" 
                    data-dismiss="modal" style="background: #ee761c">CANCELAR</button>
                {{-- @if ($selected_id < 1) --}}
                    <button type="button" wire:click.prevent="NuevoUE({{$idEmpleado}})"
                        class="btn btn-primary">GUARDAR</button>
                {{-- @else
                    <button type="button" wire:click.prevent="Update()" class="btn btn-primary close-btn">
                        <span wire:loading.remove>ACTUALIZAR</span>
                        <span wire:loading style="color: white">CARGANDO</span>
                    </button>
                @endif --}}
            </div>
        </div>
    </div>
</div>