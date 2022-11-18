<div wire:ignore.self class="modal fade" id="modal-details" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-body">

      <div class="row justify-content-center">
        <div class="col-md-8">
          <div class="card-pricing card-light">

            <span class="name-specification">Informacion de Empleado # {{$idEmpleado}}</span>
            {{-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button> --}}

            <div class="card-body">
              <ul class="specification-list">
                <li class="text-center">
                  <div class="card-header">
                    <div class="card-price">
                      <img src="{{ asset('storage/employees/' .$image)}}"
                        alt="Sin Imagen" height="90" width="100" class="img-fluid rounded-start">
                    </div>
                  </div>
                </li>
                <li>
                  <span class="name-specification">CI</span>
                  <span class="status-specification">{{$ci}}</span>
                </li>
                <li>
                  <span class="name-specification">NOMBRE</span>
                  <span class="status-specification">{{$name}}</span>
                </li>
                <li>
                  <span class="name-specification">APELLIDOS</span>
                  <span class="status-specification">{{$lastname}}</span>
                </li>
                <li>
                  <span class="name-specification">SEXO</span>
                  <span class="status-specification">{{$genero}}</span>
                </li>
                <li>
                  <span class="name-specification">FECHA DE NACIMIENTO</span>
                  <span class="status-specification">{{$dateNac}}</span>
                </li>
                <li>
                  <span class="name-specification">DIRECCION</span>
                  <span class="status-specification">{{$address}}</span>
                </li>
                <li>
                  <span class="name-specification">TELEFONO</span>
                  <span class="status-specification">{{$phone}}</span>
                </li>
                <li>
                  <span class="name-specification">ESTADO CIVIL</span>
                  <span class="status-specification">{{$estadoCivil}}</span>
                </li>
                <li>
                  <span class="name-specification">CARGO</span>
                  <span class="status-specification">{{$cargoid}}</span>
                </li>
                <li>
                  <span class="name-specification">AREA</span>
                  <span class="status-specification">{{$areaid}}</span>
                </li>
              </ul>
            </div>
            <button class="btn btn-primary"><b>Cerrar</b></button>
          </div>
        </div>
      </div>

    </div>
  </div>
</div>