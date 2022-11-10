@Include('common.modalHead')

<div class="row">

    <div class="col-sm-12 col-md-12">
        <div class="form-group">
            <h6>Nueva Funcion</h6>
            <input type="text" wire:model.lazy="funcionDeCargo" class="form-control">
            @error('funcionDeCargo')
                <span class="text-danger er">{{ $message }}</span>
            @enderror
        </div>
    </div>

</div>

@include('common.modalFooter')