      </div>
      <div class="modal-footer">
          <button type="button" wire:click.prevent="resetUI()" class="btn btn-primary"
              data-dismiss="modal" style="background: #3b3f5c">Cancelar</button>
          @if ($selected_id < 1)
              <button type="button" wire:click.prevent="Store()"
              class="btn btn-primary">Guardar</button>
          @else
              <button type="button" wire:click.prevent="Update()"
              class="btn btn-primary">Actualizar</button>
          @endif


      </div>
      </div>
      </div>
      </div>
