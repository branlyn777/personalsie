<div wire:ignore.self class="modal fade" id="theModal-UsuEmp" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white">
                    <b>Usuario Empleado</b>
                </h5>
                <h6 class="text-center text-warning" wire:loading>POR FAVOR ESPERE</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <div class="row">
                    <div class="col-sm-12 col-md-6">
                        <div class="form-group">
                            <label>Nombre</label>
                            <h4>{{$name}} {{$lastname}}</h4>
                            {{-- <input type="text" wire:model.lazy="nameu" class="form-control">
                            @error('nameu')<span class="text-danger er">{{ $message }}</span>@enderror --}}
                        </div>
                    </div>

                    {{-- <div class="col-sm-12 col-md-6">
                        <div class="form-group">
                            <label>Email</label>
                            <h4>{{$email}}</h4> --}}
                            {{-- <input type="text" wire:model.lazy="nameu" class="form-control">
                            @error('nameu')<span class="text-danger er">{{ $message }}</span>@enderror --}}
                        {{-- </div>
                    </div> --}}

                    {{-- <div class="col-sm-12 col-md-6">
                        <div class="form-group">
                            <label>Id Empleado</label>
                            <h4>{{$idEmpleado}}</h4> --}}
                            {{-- <input type="text" wire:model.lazy="nameu" class="form-control">
                            @error('nameu')<span class="text-danger er">{{ $message }}</span>@enderror --}}
                        {{-- </div>
                    </div>

                    <div class="col-sm-12 col-md-6">
                        <div class="form-group">
                            <label>IdUsuario</label>
                            <h4>{{$idUsuario}}</h4> --}}
                            {{-- <input type="text" wire:model.lazy="nameu" class="form-control">
                            @error('nameu')<span class="text-danger er">{{ $message }}</span>@enderror --}}
                        {{-- </div>
                    </div> --}}

                    {{-- <div class="col-sm-12 col-md-6">
                        <div class="form-group">
                            <label>Email</label>
                            <h4>{{$email}}</h4> --}}
                            {{-- <input type="text" wire:model.lazy="nameu" class="form-control">
                            @error('nameu')<span class="text-danger er">{{ $message }}</span>@enderror --}}
                        {{-- </div>
                    </div> --}}

                    {{-- <div class="col-sm-12 col-md-6">
                        <div class="form-group">
                            <label>Empleado</label>
                            <select wire:model="empleadoid" class="form-control">
                                <option value="Elegir" disabled>Elegir</option>
                                @foreach($empleados as $empleado)
                                <option value="{{$empleado->id}}">{{$empleado->name}}</option>
                                @endforeach
                            </select>
                            @error('empleadoid') <span class="text-danger er"> {{ $message }}</span> @enderror
                        </div>
                    </div> --}}
                
                    <div class="col-sm-12 col-md-6">
                        <div class="form-group">
                            <label>Usuario</label>
                            <select wire:model="userid" class="form-control">
                                <option value="Elegir" disabled>Elegir</option>
                                @foreach($usuarios as $usuario)
                                <option value="{{$usuario->id}}">{{$usuario->email}}</option>
                                @endforeach
                            </select>
                            {{-- @error('userid') <span class="text-danger er"> {{ $message }}</span> @enderror --}}
                        </div>
                    </div>
                </div>
  
            </div>
            <div class="modal-footer">
                <button type="button" wire:click.prevent="resetUI()" class="btn btn-primary close-btn" 
                    data-dismiss="modal" style="background: #ee761c">CANCELAR</button>
                
                <button type="button" wire:click.prevent="UsuEmploy()"
                    class="btn btn-primary">ACTUALIZAR</button>
                
            </div>
        </div>
    </div>
</div>