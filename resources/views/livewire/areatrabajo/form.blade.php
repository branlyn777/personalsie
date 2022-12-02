@Include('common.modalHead')

<div class="row">

    {{-- <div class="col-sm-12 col-md-6">
        <div class="form-group">
            <label>Cargo</label>
            <select wire:model.lazy="cargoid" class="form-control">
                <option value="Elegir" disabled>Elegir</option>
                @foreach($cargos as $cargo)
                    <option value="{{$cargo->id}}">{{$cargo->name}}</option>
                @endforeach
            </select>
            @error('cargoid') <span class="text-danger er"> {{ $message }}</span> @enderror
        </div>
    </div> --}}

    <div class="col-sm-12 col-md-6">
        <div class="form-group">
            <h6>Area de  Trabajo</h6>
            <input type="text" wire:model.lazy="nameArea" class="form-control" placeholder="Ingrese nombre">
            @error('nameArea')
                <span class="text-danger er">{{ $message }}</span>
            @enderror
        </div>
    </div>

    <div class="col-sm-12 col-md-6">
        <div class="form-group">
            <h6>Descripcion</h6>
            <input type="text" wire:model.lazy="descriptionArea" class="form-control" placeholder="Ingrese descripcion">
            @error('descriptionArea')
                <span class="text-danger er">{{ $message }}</span>
            @enderror
        </div>
    </div>

    @if ($selected_id >= 1)
        <div class="col-sm-12 col-md-5">
            <div class="form-group">
                <label>Estado de Area</label>
                    <select id="seleccion" wire:model.lazy="estadoA" class="form-control">
                        <option value="Elegir" disabled>Elegir</option>
                        <option value="Activo" selected>Activo</option>
                        <option value="Inactivo" selected>Inactivo</option>
                    </select>
                @error('estadoA') <span class="text-danger er">{{ $message }}</span> @enderror
            </div>
        </div>
    @endif

</div>

@include('common.modalFooter')
