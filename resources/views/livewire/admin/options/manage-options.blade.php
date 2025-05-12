<div>
    <section class="rounded-lg bg-white shadow-lg">
        <header class="border-b border-gray-200 px-6 py-2">
            <div class="flex justify-between items-center">
                <h2 class="font-bold text-lg">
                    Opciones
                </h2>
                <button class="btn-blue" type="button" wire:click="$set('openModal','true')">
                    Nuevo
                </button>
            </div>
        </header>
        <div class="p-6">
            <div class="space-y-6">
                @foreach($options as $option)
                    <div class="p-6 rounded-lg border border-gray-200 relative">
                        <div class="absolute bg-white -top-3 left-4">
                            <span class="px-2">
                            {{$option->name}}
                            </span>
                        </div>
                        {{-- Valores --}}
                        <div class="fle flex-wrap">
                            @foreach($option->features as $feature)
                                @switch($option->type)
                                    @case(1)
                                        {{-- Texto --}}
                                        <span
                                            class="bg-gray-100 text-gray-800 text-sm font-medium me-2 px-2.5 py-0.5 rounded-md  border border-gray-500">{{$feature->description}}</span>
                                        @break
                                    @case(2)
                                        {{-- Color --}}
                                        <span
                                            style="background-color: {{$feature->value}}"
                                            class="inline-block h-6 w-6 border border-gray-300 shadow-md rounded-full mr-4"></span>
                                        @break
                                @endswitch
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <x-dialog-modal wire:model="openModal">
        <x-slot name="title">
            Crear una nueva Opción
        </x-slot>
        <x-slot name="content">
            <x-validation-errors/>
            <div class="grid grid-cols-2 gap-6 mb-4">
                <div>
                    <x-label class="mb-1">Nombre</x-label>
                    <x-input
                        wire:model="newOption.name"
                        placeholder="Ejemplo:Tamaño, Color"
                        class="w-full"/>
                </div>
                <div>
                    <x-label class="mb-1">Tipo</x-label>
                    <x-select class="w-full" wire:model.live="newOption.type">
                        <option value="1">Texto</option>
                        <option value="2">Color</option>
                    </x-select>
                </div>
            </div>
            <div class="flex items-center mb-4">
                <hr class="flex-1">
                <span class="mx-2">Valores</span>
                <hr class="flex-1">
            </div>
            <div class="mb-4 space-y-4">
                @foreach($newOption['features'] as $index => $feature)
                    <div
                        wire:key="features-{{$index}}"
                        class="p-6 rounded-lg border border-gray-200 relative">

                        <div class="absolute -top-3 bg-white left-6 px-3">
                            <button wire:click="removeFeature({{$index}})">
                                <i class="fa-solid fa-trash-can text-red-500 hover:text-red-700"></i>
                            </button>
                        </div>
                        <div class="grid grid-cols-2 gap-6">
                            <div>
                                <x-label class="mb-1">Valor</x-label>
                                @switch($newOption['type'])
                                    @case(1)
                                        <x-input
                                            wire:model="newOption.features.{{$index}}.value"
                                            placeholder="Ingrese el valor de la opción"
                                            class="w-full"/>
                                        @break
                                    @case(2)
                                        <div
                                            class="border border-gray-300 h-[42px] rounded-lg flex items-center justify-between px-3">
                                            {{$newOption['features'][$index]['value']?: 'Seleccione un color'}}
                                            <input
                                                class=""
                                                wire:model.live="newOption.features.{{$index}}.value"
                                                type="color">

                                        </div>
                                @endswitch
                            </div>
                            <div>
                                <x-label class="mb-1">Descripción</x-label>
                                <x-input
                                    wire:model="newOption.features.{{$index}}.description"
                                    placeholder="Ingrese una descripción"
                                    class="w-full"/>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
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
</div>
