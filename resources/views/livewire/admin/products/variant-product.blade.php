<div xmlns="http://www.w3.org/1999/html">
    <section class="rounded-lg bg-white shadow-lg">
        <header class="border-b px-6 py-2">
            <div class="flex justify-between items-center">
                <h2 class="font-bold text-lg ">Opciones</h2>
                <button class="btn-blue" wire:click="$set('openModal','true')">
                    Nuevo
                </button>
            </div>
            <div class="p-6">
                @if($product->options->count()>0)
                    <div class="space-y-6">
                        @foreach($product->options as $option)
                            <div wire:key="product-option{{$option->id}}"
                                 class="p-6 rounded-lg border border-gray-200 relative">
                                <div class="absolute -top-3 left-4 bg-white px-2">
                                    <button onclick="deleteOption({{$option->id}})">
                                        <i class="fa-solid fa-trash-can text-red-500 hover:text-red-700"></i>
                                    </button>
                                    <span class="ml-1">{{$option->name}}</span>
                                </div>
                                <div class="flex flex-wrap">
                                    @foreach($option->pivot->features as $feature)
                                        @switch($option->type)
                                            @case(1)
                                                {{-- Caso 1 es tipo texto --}}
                                                <span
                                                    class="bg-gray-100 text-gray-800 text-sm font-medium me-2 pl-2.5 pr-1.5 p-0.5 rounded-md  border border-gray-500">{{$feature['description']}}
                                                <button class="ml-0.5"
                                                        onclick="confirmDeleteFeature({{$option->id}},{{$feature['id']}})"

                                                        {{-- wire:click="deleteFeature({{$feature->id}})" --}}
                                                >
                                                    <i class="fa-solid fa-xmark hover:text-red-500"></i>
                                                </button>
                                        </span>

                                                @break
                                            @case(2)
                                                {{-- Caso 2 es tipo color --}}
                                                <div class="relative">
                                            <span style="background-color:{{ $feature['value'] }}"
                                                  class="inline-block h-6 w-6 border border-gray-300 shadow-md rounded-full mr-4">
                                            </span>
                                                    <button
                                                        onclick="confirmDeleteFeature({{$option->id}},{{$feature['id']}})"
                                                        class="absolute z-10 -top-2 left-5 rounded-full bg-red-500 hover:bg-red-700 w-4 flex justify-center items-center">
                                                        <i class="fa-solid fa-xmark text-xs text-white"></i>
                                                    </button>
                                                </div>
                                                @break
                                        @endswitch
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="flex items-center p-4 text-sm text-blue-800 rounded-lg bg-blue-50 dark:bg-gray-800 dark:text-blue-400" role="alert">
                        <svg class="shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                        </svg>
                        <span class="sr-only">Info</span>
                        <div>
                            <span class="font-medium">Alerta!</span> Aún no hay opciones para este producto.
                        </div>
                    </div>
                @endif
            </div>
        </header>
    </section>
    <x-dialog-modal wire:model="openModal">
        <x-slot name="title">Agregar una nueva opción</x-slot>
        <x-slot name="content">
            <x-validation-errors></x-validation-errors>
            <div class="mb-4">
                <x-label class="mb-1">
                    Opción
                </x-label>
                <x-select class="w-full" wire:model.live="variant.option_id">
                    <option value="">Seleccione una opción</option>
                    @foreach($options as $option)
                        <option value="{{$option->id}}">
                            {{$option->name}}
                        </option>
                    @endforeach
                </x-select>
            </div>
            <div class="flex items-center mb-4">
                <hr class="flex-1">
                <span class="px-2">Valores</span>
                <hr class="flex-1">
            </div>
            <div>
                <ul class="mb-4 space-y-4">
                    @foreach($variant['features'] as $index => $feature)
                        <li wire:key="variant-feature-{{$index}}"
                            class=" border border-gray-200 rounded-lg p-6 relative">
                            <div class="absolute -top-3 left-4 bg-white px-2">
                                <button wire:click="deleteFeature({{$index}})"><i
                                        class="fa-solid fa-trash-can text-red-500 hover:text-red-700"></i></button>
                            </div>
                            <div>
                                <x-label class="mb-1">
                                    Valores
                                </x-label>
                                {{-- Tener en cuenta con quien enlazamos el valor --}}
                                <x-select class="w-full"
                                          wire:model="variant.features.{{$index}}.id"
                                          {{-- Esta escuchando cambios de los option --}}
                                          wire:change="featureChange({{$index}})">
                                    <option value="">Seleccione un valor</option>
                                    @foreach($this->features as $item)
                                        <option value="{{$item->id}}">
                                            {{$item->description}}
                                        </option>
                                    @endforeach
                                </x-select>
                            </div>
                        </li>
                    @endforeach
                </ul>
                <div class="flex justify-end">
                    <button class="btn-blue" wire:click="addFeature">
                        Agregar valor
                    </button>
                </div>

            </div>
        </x-slot>
        <x-slot name="footer">
            <div class="flex justify-end">
                <button class="btn-red" wire:click="$set('openModal',false)">
                    Cancelar
                </button>
                <button class="btn-green" wire:click="save">
                    Guardar
                </button>
            </div>
        </x-slot>
    </x-dialog-modal>
    @push('warning-alert')
        <script>
            function confirmDeleteFeature(option_id, feature_id) {
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
                    @this.call('removeFeature', option_id, feature_id)
                    }
                });
            }

            function deleteOption(option_id) {
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
                    @this.call('deleteOption', option_id)
                    }
                });
            }
        </script>
    @endpush
</div>
