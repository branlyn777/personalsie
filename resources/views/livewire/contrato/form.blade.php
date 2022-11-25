@Include('common.modalHead')

<div class="row">
    <div class="col-sm-12 col-md-6">
        <div class="form-group">
            <label>Empleado</label>
            <select wire:model="employeeid" class="form-control">
                <option value="Elegir" disabled>Elegir</option>
                @foreach($empleados as $empleado)
                <option value="{{$empleado->id}}">{{$empleado->name}}</option>
                @endforeach
            </select>
            @error('employeeid') <span class="text-danger er"> {{ $message }}</span> @enderror
        </div>
    </div>

    <div class="col-sm-12 col-md-6">
        <div class="form-group">
            <label>Fecha de Inicio</label>
            <input type="date" wire:model.lazy="fechaInicio" class="form-control">
            @error('fechaInicio') <span class="text-danger er">{{ $message }}</span> @enderror
        </div>
    </div>

    <div class="col-sm-12 col-md-6">
        <div class="form-group">
            <label>Fecha de Final</label>
            <input type="date" wire:model.lazy="fechaFin" class="form-control">
            @error('fechaFin') <span class="text-danger er">{{ $message }}</span> @enderror
        </div>
    </div>

    <div class="col-sm-12 col-md-6">
        <div class="form-group">
            <label>Descripcion</label>
            <input type="text" wire:model.lazy="descripcion" class="form-control" placeholder="Ingrese descripcion de contrato">
        </div>
        @error('descripcion') <span class="text-danger er">{{ $message }}</span> @enderror
    </div>

    {{-- <div class="col-sm-12 col-md-6">
        <div class="form-group">
            <label>Nota</label>
            <textarea type="text" class="form-control" wire:model.lazy="nota" placeholder="Ingrese nota de contrato"></textarea>
        </div>
        @error('nota') <span class="text-danger er">{{ $message }}</span> @enderror
    </div> --}}

    <div class="col-sm-12 col-md-6">
        <div class="form-group">
            <label>Salario</label>
            <input type="number" class="form-control" wire:model.lazy="salario" placeholder="0.00">
            @error('salario') <span class="text-danger er">{{ $message }}</span> @enderror
        </div>
    </div>

    {{-- <div class="col-sm-12 col-md-6">
        <div class="form-group">
            <label>Funciones</label>
            <select wire:model="funcionid" class="form-control">
                <option value="Elegir" disabled>Elegir</option>
                @foreach($funciones as $funcion)
                <option value="{{$funcion->id}}">{{$funcion->name}}</option>
                @endforeach
            </select>
            @error('funcionid') <span class="text-danger er"> {{ $message }}</span> @enderror
        </div>
    </div> --}}

    @if ($selected_id >= 1)
        <div class="col-sm-12 col-md-5">
            <div class="form-group">
                <label>Estado de Vigencia</label>
                <select id="seleccion" wire:model="estadoV" class="form-control">
                    <option value="Elegir" disabled>Elegir</option>
                    <option value="Vigente" selected>Vigente</option>
                    <option value="No Vigente" selected>No Vigente</option>
                </select>
                @error('estadoV') <span class="text-danger er">{{ $message }}</span> @enderror
            </div>
        </div>

                <div class="col-sm-12 col-md-5">
                    <div class="form-group">
                        <label>Estado de Contrato</label>
                        <select id="seleccion" wire:model="estadoC" class="form-control">
                            <option value="Elegir" disabled>Elegir</option>
                            <option value="Activo" selected>Activo</option>
                            <option value="Inactivo" selected>Inactivo</option>
                        </select>
                        @error('estadoC') <span class="text-danger er">{{ $message }}</span> @enderror
                    </div>
                </div>
    @endif
</div>

@include('common.modalFooter')


