<div>
    <section class="rounded-lg bg-white shadow-lg">
        <header class="border-b border-gray-200 px-6 py-2">
            <div class="flex justify-between items-center">
                <h2 class="font-bold text-lg">Opciones</h2>
                <button class="btn-blue" wire:click="$set('newOption.openModal','true')">
                    Nuevo
                </button>
            </div>
        </header>
        <div class="p-6">
            <div class="space-y-6">
                @foreach($options as $option)
                    <div wire:key="option-{{$option->id}}" class="p-6 rounded-lg border border-gray-200 relative">
                        <div class="absolute bg-white -top-3 left-4">
                            <span class="px-2">{{$option->name}}</span>
                        </div>
                        {{-- Valores --}}
                        <div class="flex flex-wrap mb-4">
                            @foreach($option->features as $feature)
                                @switch($option->type)
                                    @case(1)
                                        {{-- Caso 1 es tipo texto --}}
                                        <span
                                            class="bg-gray-100 text-gray-800 text-sm font-medium me-2 pl-2.5 pr-1.5 p-0.5 rounded-md  border border-gray-500">{{$feature->description}}
                                                <button class="ml-0.5"
                                                        onclick="confirmDelete({{$feature->id}})"
                                                        {{-- wire:click="deleteFeature({{$feature->id}})" --}}
                                                >
                                                    <i class="fa-solid fa-xmark hover:text-red-500"></i>
                                                </button>
                                        </span>

                                        @break
                                    @case(2)
                                        {{-- Caso 2 es tipo color --}}
                                        <div class="relative">
                                            <span style="background-color:{{ $feature->value }}"
                                                  class="inline-block h-6 w-6 border border-gray-300 shadow-md rounded-full mr-4">
                                            </span>
                                            <button
                                                onclick="confirmDelete({{$feature->id}})"
                                                class="absolute z-10 -top-2 left-5 rounded-full bg-red-500 hover:bg-red-700 w-4 flex justify-center items-center">
                                                <i class="fa-solid fa-xmark text-xs text-white"></i>
                                            </button>
                                        </div>
                                        @break
                                @endswitch
                            @endforeach
                        </div>
                        @livewire('admin.options.add-new-feature',['option'=> $option],
                        key('add-new-feature-'.$option->id))
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    {{-- Donde vamos a  Crear opciones --}}
    <x-dialog-modal wire:model="newOption.openModal">
        <x-slot name="title">
            Crear una nueva opción
        </x-slot>
        <x-slot name="content">
            <x-validation-errors/>
            <div class="grid grid-cols-2 gap-6 mb-4">
                <div class="mb-1">
                    <x-label>Nombre</x-label>
                    <x-input wire:model="newOption.name"
                             class="w-full" placeholder="Ingresa en nombre de la nueva opción"/>
                </div>
                <div class="mb-1">
                    <x-label>Tipo</x-label>
                    <x-select wire:model.live="newOption.type" class="w-full">
                        <option value="1">Texto</option>
                        <option value="2">Color</option>
                    </x-select>
                </div>
            </div>
            {{-- Seccion de features para las opciones --}}
            <div class="flex items-center mb-4">
                <hr class="flex-1">
                <span class="mx-2">Valores</span>
                <hr class="flex-1">
            </div>
            <!-- Lista de características -->
            @foreach($newOption->features as $index => $feature)
                <div wire:key="features-{{$index}}" class="relative mb-4 p-6 rounded-lg border border-gray-200">
                    <div class="absolute -top-3 bg-white left-6 px-3">
                        <button wire:click="removeFeature({{$index}})">
                            <i class="fa-solid fa-trash-can text-red-500 hover:text-red-700"></i>
                        </button>
                    </div>
                    <div class="grid grid-cols-2 gap-6">
                        <div>
                            <x-label class="mb-1">Valor</x-label>
                            @switch($newOption->type)
                                @case(1)
                                    <div>
                                        <x-input wire:model="newOption.features.{{$index}}.value" class="w-full"/>
                                    </div>
                                    @break
                                @case(2)
                                    <div
                                        class="border border-gray-300 h-[42px] rounded-lg flex items-center justify-between px-3">
                                        {{$newOption->features[$index]['value']?: "Seleccione un color"}}
                                        <input wire:model.live="newOption.features.{{$index}}.value" type="color">
                                    </div>
                            @endswitch
                        </div>
                        <div>
                            <x-label class="mb-1">Descripción</x-label>
                            <x-input wire:model="newOption.features.{{$index}}.description" class="w-full"/>
                        </div>
                    </div>
                </div>
            @endforeach
            <div class="flex justify-end">
                <button class="btn-blue" wire:click="addFeature">
                    Agregar valor
                </button>
            </div>

        </x-slot>
        <x-slot name="footer">
            <button class="btn-green" wire:click="addOption">
                Crear Opción
            </button>
        </x-slot>
    </x-dialog-modal>
    @push('warning-alert')
        <script>
            function confirmDelete(featureId) {
                Swal.fire({
                    title: "¿Estás seguro?",
                    text: "¡No podrás revertir esto!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "¡Sí, bórralo!",
                    cancelButtonText: "Cancelar"
                }).then((result) => {
                    if (result.isConfirmed) {
                        // console.log(featureId)
                    @this.call('deleteFeature', featureId);
                    }
                });
            }

        </script>
    @endpush
</div>
