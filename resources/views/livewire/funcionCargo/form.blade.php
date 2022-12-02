@Include('common.modalHead')

<div class="row">

    <div class="col-sm-12 col-md-6">
        <div class="form-group">
            <h6>Cargo</h6>
            <select wire:model.lazy="cargoid" class="form-control">
                <option value="Elegir" disabled>Elegir</option>
                @foreach($cargos as $cargo)
                    <option value="{{$cargo->id}}">{{$cargo->name}}</option>
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

@include('common.modalFooter')