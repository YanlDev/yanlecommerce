<div class="p-4">
    <form class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-[1fr_1fr_auto] gap-4" wire:submit="addFeature">
        <div class="w-full">
            <x-label class="mb-1">Valor</x-label>
            @switch($option->type)
                @case(1)
                    <div>
                        <x-input wire:model="newFeature.value" class="w-full" placeholder="Ingrese un valor"/>
                    </div>
                    @break
                @case(2)
                    <div class="border border-gray-300 h-[42px] rounded-lg flex items-center justify-between px-3">
                        <span class="truncate max-w-[80%]">{{$newFeature['value']?: "Seleccione un color"}}</span>
                        <input wire:model.live="newFeature.value" type="color" class="h-6 w-10">
                    </div>
                    @break
            @endswitch
        </div>
        <div class="w-full">
            <x-label class="mb-1">Descripción</x-label>
            <x-input wire:model="newFeature.description" class="w-full" placeholder="Ingrese una descripción"/>
        </div>
        <div class="flex items-end md:pt-0 pt-2 w-full md:w-auto">
            <button class="btn-green w-full md:w-auto">
                Agregar
            </button>
        </div>
        <x-validation-errors></x-validation-errors>
    </form>
</div>
