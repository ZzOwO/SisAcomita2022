<div>
    <x-jet-dialog-modal wire:model="isOpen">
      <x-slot name="title">
        <h3>Nuevo Stand</h3>
      </x-slot>
      <x-slot name="content">
        <div class="flex justify-between mx-2 mb-6">
            <div class="mb-2 md:mr-2 md:mb-0 w-full">
                <x-jet-label value="Ubicacion" class="font-bold"/>
                <x-jet-input type="text" wire:model.defer="stand.name" class="w-full"/>
                <x-jet-input-error for="stand.name"/>
            </div>
            <div class="mb-2 md:mr-2 md:mb-0 w-full">
                <x-jet-label value="Estado" class="font-bold"/>
                <select wire:model.defer="stand.status" class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm w-full">
                    <option>Seleccione Opción</option>
                    <option value="Alquilado">Alquilado</option>
                    <option value="Problemas">Problemas</option>
                    <option value="Normal">Normal</option>
                </select>
                <x-jet-input-error for="stand.status"/>
            </div>
        </div>

      </x-slot>
      <x-slot name="footer">
        <x-jet-secondary-button wire:click="$set('isOpen',false)" class="mx-2">Cancelar</x-jet-secondary-button>
        <!-- <x-jet-button wire:click="store" wire:loading.remove wire:target="store">Registrar</x-jet-button> -->
        <x-jet-button wire:click.prevent="store()" wire:loading.attr="disabled" wire:target="store" class="disabled:opacity-25">
          Registrar
        </x-jet-button>
        <!-- <span wire:loading wire:target="store">Cargando...</span> -->
      </x-slot>

    </x-jet-dialog-modal>
    @push('js')

    @endpush
</div>
