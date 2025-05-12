<div class="card">
    <form wire:submit="store">
        <div class="mb-4">
            <x-label class="mb-2">
                Subcategoría
            </x-label>
            <x-input
                wire:model="name"
                class="w-full"
                placeholder="Ingresa el nombre de la nueva subcategoría"
            />
        </div>

        <div class="mb-4">
            <x-label class="mb-2">
                Familia
            </x-label>
            <x-select class="w-full" wire:model.live="selectedFamilyId">
                <option value="">Seleccione una familia</option>
                @foreach($families as $family)
                    <option value="{{$family->id}}">
                        {{$family->name}}
                    </option>
                @endforeach
            </x-select>
        </div>

        <div class="mb-4">
            <x-label class="mb-2">
                Categorías
            </x-label>
            <x-select class="w-full" wire:model.live="selectedCategoryId">
                <option value="">Seleccione una categoría</option>
                @foreach($categories as $category)
                    <option value="{{$category->id}}">
                        {{$category->name}}
                    </option>
                @endforeach
            </x-select>
        </div>
        <div class="mb-4 flex justify-end">
            <button type="submit" class="btn-green">
                Agregar
            </button>
        </div>

{{--        <div>--}}
{{--            <!-- Tus inputs y selects aquí -->--}}
{{--            @dump([--}}
{{--                'selectedFamilyId' => $selectedFamilyId,--}}
{{--                'selectedCategoryId' => $selectedCategoryId,--}}
{{--                'categories' => $categories--}}
{{--            ])--}}
{{--        </div>--}}

        <x-validation-errors></x-validation-errors>
    </form>
</div>
