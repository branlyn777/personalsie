@Include('common.modalHead')

<div class="row">

    <div class="col-sm-12 col-md-6">
        <div class="form-group">
            <label>Empledos</label>
            <select wire:model="empleadoid" class="form-control">
                <option value="Elegir" disabled>Elegir</option>
                @foreach($empleados as $a)
                <option value="{{$a->id}}">{{$a->name}} {{$a->lastname}}</option>
                @endforeach
            </select>
            @error('empleadoid') <span class="text-danger er"> {{ $message }}</span> @enderror
        </div>
    </div>

    <div class="col-sm-12 col-md-6">
        <div class="form-group">
            <h6>Fecha</h6>
            <input type="date" wire:model.lazy="fecha" class="form-control">
            @error('fecha')
                <span class="text-danger er">{{ $message }}</span>
            @enderror
        </div>
    </div>

    <div class="col-sm-12 col-md-6">
        <div class="form-group">
            <h6>Motivo</h6>
            <textarea type="text" wire:model.lazy="motivo" class="form-control" placeholder="Ingrese motivo de ausencia"></textarea>
            @error('motivo') <span class="text-danger er">{{ $message }}</span> @enderror
        </div>
    </div>

    <div class="col-sm-12 col-md-6">
        <div class="form-group">
            <label>Tipo de Ausencia</label>
                <select id="seleccion" wire:model="estadoA" class="form-control">
                    <option value="Elegir" disabled>Elegir</option>
                    <option value="Permiso" selected>Permiso</option>
                    <option value="Licencia" selected>Licencia</option>
                </select>
            @error('estadoA') <span class="text-danger er">{{ $message }}</span> @enderror
        </div>
    </div>

    <div class="col-sm-12 col-md-12 mt-3">
        <div class="form-group custom-file">
            <input type="file" class="custom-file-input form-control img-thumbnail center-block" wire:model="comprobante" accept="comprobante/x-png, comprobante/gif, comprobante/jpeg">
            <label for="" class="custom-file-label">Comprobante {{$comprobante}}</label>
            @error('comprobante') <span class="text-danger er"> {{ $message }}</span> @enderror
        </div>
    </div>

</div>

@include('common.modalFooter')
