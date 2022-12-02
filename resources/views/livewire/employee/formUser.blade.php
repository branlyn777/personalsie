<div wire:ignore.self class="modal fade" id="theModal-formUser" tabindex="-1" role="dialog" style="overflow-y: scroll;">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white">
                    <b>{{ $componentNameU }}</b> | {{ $selected_id > 0 ? 'EDITAR' : 'CREAR' }}
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
                            <label>Telefono</label>
                            <h4>{{$phone}}</h4>
                            {{-- <input type="number" wire:model.lazy="phoneu" class="form-control">
                            @error('phoneu')<span class="text-danger er">{{ $message }}</span>@enderror --}}
                        </div>
                    </div>

                    <div class="col-sm-12 col-md-6">
                        <div class="form-group">
                            <h6>Email</h6>
                            <input type="email" wire:model.lazy="email" class="form-control" placeholder="ej: correo@correo.com">
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
                            <select wire:model.lazy='profile' class="form-control">
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
                            <select wire:model.lazy='sucursal_id' class="form-control">
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
                    
                    {{-- <div class="col-sm-12 col-md-12">
                        <div class="form-group custom-file">
                            <div class="card-header">
                                <div class="card-price">
                                  <img src="{{ asset('storage/usuarios/' .$image)}}"
                                    alt="Sin Imagen" height="90" width="100" class="img-fluid rounded-start">
                                </div>
                              </div>
                        </div>
                    </div> --}}

                </div>
            </div>

            <div class="modal-footer">
                <button type="button" wire:click.prevent="resetUI()" class="btn btn-primary close-btn" 
                    data-dismiss="modal" style="background: #ee761c">CANCELAR</button>
                {{-- @if ($selected_id < 1) --}}
                    <button type="button" wire:click.prevent="NuevoUsuario({{$idEmpleado}})"
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