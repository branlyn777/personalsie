<div wire:ignore.self class="modal fade" id="theModal-formUser" tabindex="-1" role="dialog" style="overflow-y: scroll;">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white">
                    <b>{{ $componentNameU }}</b> | {{ $selected_id > 0 ? 'EDITAR' : 'CREAR' }}
                </h5>
                <h6 class="text-center text-warning" wire:loading>POR FAVOR ESPERE</h6>
            </div>

            <div class="col-sm-12 col-md-6">
                <div class="form-group">
                    <label>Nombre y Apellido</label>
                    <h4>{{$name}} {{$lastname}}</h4>
                    {{-- <input type="text" wire:model.lazy="name" class="form-control" disabled> --}}
                </div>
            </div>

            <div class="col-sm-12 col-md-6">
                <div class="form-group">
                    <label>Telefono</label>
                    <h4>{{$phone}}</h4>
                    {{-- <input type="text" wire:model.lazy="name" class="form-control" disabled> --}}
                </div>
            </div>

            <div class="col-sm-12 col-md-6">
                <div class="form-group">
                    <h6>Email</h6>
                    <input type="text" wire:model.lazy="email" class="form-control" placeholder="ej: correo@correo.com">
                    @error('email')
                        <span class="text-danger er">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="col-sm-12 col-md-6">
                <div class="form-group">
                    @if ($selected_id == 0)
                        <h6>Contraseña</h6>
                    @else
                        <h6>Nueva contraseña (opcional)</h6>
                    @endif
                    <input type="password" date-type='currency' wire:model.lazy="password" class="form-control">
                    @error('password')
                        <span class="text-danger er">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="col-sm-12 col-md-6">
                <div class="form-group">
                    <h6>Asignar rol</h6>
                    <select wire:model='profiles' class="form-control">
                        <option value="Elegir" disabled selected>Elegir</option>
                        @foreach ($roles as $role)
                            <option value="{{ $role->name }}">{{ $role->name }}</option>
                        @endforeach
                    </select>
                    @error('profile')<span class="text-danger er">{{ $message }}</span>@enderror
                </div>
            </div>

            <div class="col-sm-12 col-md-6">
                <div class="form-group">
                    <h6>Sucursal</h6>
                    <select wire:model='sucursal_id' class="form-control">
                        <option value="Elegir" disabled selected>Elegir</option>
                        @foreach ($sucursales as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                    </select>
                    @error('sucursal_id')
                        <span class="text-danger er">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            {{-- <div class="row">
                <div class="col-sm-12 col-md-6">
                    <div class="form-group">
                        <h6>Email</h6>
                        <input type="text" wire:model.lazy="email" class="form-control" placeholder="ej: correo@correo.com">
                        @error('email')<span class="text-danger er">{{ $message }}</span>@enderror
                    </div>
                </div>

                <div class="col-sm-12 col-md-6">
                    <div class="form-group">
                        @if ($selected_id == 0)
                            <h6>Contraseña</h6>
                        @else
                            <h6>Nueva contraseña (opcional)</h6>
                        @endif
                        <input type="password" date-type='currency' wire:model.lazy="password" class="form-control">
                        @error('password')<span class="text-danger er">{{ $message }}</span>@enderror
                    </div>
                </div>

                <div class="col-sm-12 col-md-6">
                    <div class="form-group">
                        <h6>Asignar rol</h6>
                        <select wire:model='profile' class="form-control">
                            <option value="Elegir" disabled selected>Elegir</option>
                            @foreach ($roles as $role)
                                <option value="{{ $role->name }}">{{ $role->name }}</option>
                            @endforeach
                        </select>
                        @error('profile')<span class="text-danger er">{{ $message }}</span>@enderror
                    </div>
                </div>

                @if ($selected_id == 0)
                    <div class="col-sm-12 col-md-6">
                        <div class="form-group">
                            <h6>Sucursal</h6>
                            <select wire:model='sucursal_id' class="form-control">
                                <option value="Elegir" disabled selected>Elegir</option>
                                @foreach ($sucursales as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                            @error('sucursal_id')<span class="text-danger er">{{ $message }}</span>@enderror
                        </div>
                    </div>
                @endif
                <div class="col-sm-12 col-md-12">
                    <div class="form-group custom-file">
                        <input type="file" class="custom-file-input form-control" wire:model="image"
                            accept="image/x-png,image/gif,image/jpeg">
                        <label class="custom-file-label">Imagen {{ $image }}</label>
                    </div>
                </div>
            </div> --}}

            <div class="modal-footer">
                <button type="button" wire:click.prevent="resetUI()" class="btn btn-primary close-btn" 
                    data-dismiss="modal" style="background: #ee761c">CANCELAR</button>
                @if ($selected_id < 1)
                    <button type="button" wire:click.prevent="formUser('{{$idEmpleado}}')"
                        class="btn btn-primary">GUARDAR</button>
                @else
                    <button type="button" wire:click.prevent="Update()" class="btn btn-primary close-btn">
                        <span wire:loading.remove>ACTUALIZAR</span>
                        <span wire:loading style="color: white">CARGANDO</span>
                    </button>
                @endif
            </div>
        </div>
    </div>
</div>