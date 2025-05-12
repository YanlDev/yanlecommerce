<div>
    <div class="card">
        <form wire:submit="update">
            <div class="mb-4">
                <x-label class="mb-2">
                    Subcategoría
                </x-label>
                <x-input
                    wire:model="name"
                    class="w-full"
                    placeholder="Ingrese el nombre de la subcategoría a editar"
                />
            </div>
            <div class="mb-4">
                <x-label class="mb-2">
                    Familia
                </x-label>
                <x-select class="w-full" wire:model.live="selectedFamilyId">
                    <option value="" disabled>Selecciona una familia</option>
                    @foreach($families as $family)
                        <option value="{{$family->id}}">
                            {{$family->name}}
                        </option>
                    @endforeach
                </x-select>
            </div>
            <div class="mb-4">
                <x-label class="mb-2">
                    Categoría
                </x-label>
                <x-select class="w-full" wire:model.live="selectedCategoryId">
                    <option value="" disabled>Selecciona una categoría</option>
                    @foreach($this->categories as $category)
                        <option value="{{$category->id}}">
                            {{$category->name}}
                        </option>
                    @endforeach
                </x-select>
            </div>
            <div class="flex justify-end mb-2">
                <button class="btn-red mr-2" type="button" onclick="confirmDelete()">
                    Eliminar
                </button>
                <button type="submit" class="btn-green">
                    Actualizar
                </button>
            </div>
        </form>
        <x-validation-errors></x-validation-errors>
    </div>
    <form id="deleteForm" action="{{route('admin.subcategories.destroy',$subcategory)}}" method="post" class="hidden">
        @csrf
        @method('DELETE')
    </form>

    <!-- Área de depuración -->
    {{--    <div class="mt-6 p-4 bg-gray-100 rounded-lg overflow-auto">--}}
    {{--        <h3 class="font-bold mb-2">Debug Info:</h3>--}}
    {{--        <div class="text-xs">--}}
    {{--            <p><strong>Familia seleccionada ID:</strong> {{ $selectedFamilyId }}</p>--}}
    {{--            <p><strong>Categoría seleccionada ID:</strong> {{ $selectedCategoryId }}</p>--}}
    {{--            <p><strong>Total de familias:</strong> {{ count($families) }}</p>--}}
    {{--            <p><strong>Total de categorías:</strong> {{ count($this->categories) }}</p>--}}

    {{--            <div class="mt-2">--}}
    {{--                <strong>Lista de Categorías:</strong>--}}
    {{--                <pre>{{ json_encode($this->categories->pluck('name', 'id'), JSON_PRETTY_PRINT) }}</pre>--}}
    {{--            </div>--}}
    {{--        </div>--}}
    {{--    </div>--}}


    @push('warning-alert')
        <script>
            function confirmDelete() {
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
                        document.getElementById('deleteForm').submit();
                    }
                });
            }

        </script>
    @endpush


</div>
