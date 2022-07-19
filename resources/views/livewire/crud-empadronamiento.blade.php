<div class="py-0">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class=" dark:bg-gray-700  overflow-hidden shadow-xl sm:rounded-lg px-3 py-2 mb-2">
            <h1 class="mt-2 text-center text-2xl font-bold text-white">¡Menú Empadronamiento!</h1>
        </div>
      <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-4 py-4">
        <div class="flex items-center justify-between">
            <!--Input de busqueda   -->
            <div class="flex items-center p-2 rounded-md flex-1">
                <label class=" w-full relative text-gray-400 focus-within:text-gray-600 block">
                    <svg class="pointer-events-none w-8 h-8 absolute top-1/2 transform -translate-y-1/2 left-3" viewBox="0 0 25 25"  fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" class="w-6 h-6"><path d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    <x-jet-input type="text" wire:model="search" class="w-full block pl-14" placeholder="Buscar equipo..."/>
                </label>
            </div>
            <!--Boton nuevo   -->
            <div class="lg:ml-40 ml-10 space-x-8">
                <button wire:click="create()" class="bg-indigo-600 px-4 py-2 rounded-md text-white font-semibold tracking-wide cursor-pointer" >
                    <i class="fa fa-users" aria-hidden="true"></i> Nuevo
                </button>
                @if($isOpen)
                    @include('livewire.add-empadronamiento')
                @endif
            </div>
        </div>
        <!--Tabla lista de items   -->
        <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
            <table class="w-full divide-y divide-gray-200 table-auto">
              <thead class="bg-indigo-500 text-white">
                <tr class="text-left text-xs font-bold  uppercase">
                  <td wire:click="order('id')" scope="col" class="px-6 py-3 cursor-pointer">ID</td>
                  <td scope="col" class="px-6 py-3 cursor-pointer">codigo</td>
                  <td scope="col" class="px-6 py-3 cursor-pointer">Socio</td>
                  <td wire:click="order('fullname')" scope="col" class="px-6 py-3 cursor-pointer">Stand</td>
                  <td scope="col" class="px-6 py-3 cursor-pointer">Period</td>

                  <td wire:click="order('number')" scope="col" class="px-6 py-3">Opciones</td>
                </tr>
              </thead>
              <tbody class="divide-y divide-gray-200">
                @foreach ($empadronamientos as $item)
                <tr class="text-sm font-medium text-gray-900">
                  <td class="px-6 py-4">
                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-indigo-500 text-white">
                      {{$item->id}}
                    </span>
                  </td>

                  <td class="px-6 py-4">{{$item->code}}</td>
                  <td class="px-6 py-4">{{$item->partner->name}}</td>
                  <td class="px-6 py-4">{{$item->stand->name}}</td>
                  <td class="px-6 py-4">{{$item->period->name}}</td>


                  <td class="px-6 py-4">
                    {{-- @livewire('cliente-edit',['cliente'=>$item],key($item->id)) --}}
                    <x-jet-button wire:click="edit({{$item}})"> <!-- Usamos metodos magicos -->
                        <i class="fas fa-edit"></i>
                    </x-jet-button>
                    <x-jet-danger-button wire:click="$emit('deleteItem',{{$item->id}})"> <!-- Usamos metodos magicos -->
                        <i class="fas fa-trash"></i>
                    </x-jet-danger-button>
                  </td>
                </tr>
                @endforeach
                <!-- More people... -->
              </tbody>
            </table>
        </div>
        @if(!$empadronamientos->count())
            No existe ningun registro conincidente
        @endif
        @if($empadronamientos->hasPages())
            <div class="px-6 py-3">
            {{$empadronamientos->links()}}
            </div>
        @endif

      </div>
    </div>

      <!--Scripts - Sweetalert   -->
      @push('js')
        <script>
          Livewire.on('deleteItem',id=>{
            Swal.fire({
              title: 'Are you sure?',
              text: "You won't be able to revert this!",
              icon: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Yes, delete it!'
              }).then((result) => {
                if (result.isConfirmed) {
                    //alert("del");
                    Livewire.emitTo('crud-empadronamiento','delete',id);
                    Swal.fire(
                        'Deleted!',
                        'Your file has been deleted.',
                        'success'
                    )

                }
              })
          });
        </script>
      @endpush
</div>
