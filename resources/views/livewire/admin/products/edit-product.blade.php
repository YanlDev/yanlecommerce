<div class="card">
    <form wire:submit="update">

        <div class="mb-4">
            <x-label class="mb-2">
                Producto
            </x-label>
            <x-input
                wire:model="name"
                class="w-full"
                placeholder="Ingrese el nombre del producto a crear"
            />
        </div>
        <div class="mb-4">
            <x-label class="mb-2">
                Imagen del producto
            </x-label>
            <div
                class="relative w-full h-64 bg-slate-100 rounded-lg border-2 border-dashed border-slate-300 hover:border-blue-500 transition-colors flex items-center justify-center overflow-hidden">
                @if($newImage)
                    <img src="{{ $newImage->temporaryUrl()}}" alt="Vista previa del producto"
                         class="object-contain w-full h-full">
                    <div class="absolute inset-0 bg-black bg-opacity-10"></div>

                @elseif($product->image_path)
                    <!-- Imagen existente del producto -->
                    <img src="{{Storage::url($product->image_path)}}" alt="Imagen del producto"
                         class="object-contain w-full h-full"
                    >
                    <div class="absolute inset-0 bg-black bg-opacity-10"></div>
                @else
                    <div class="text-center p-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-slate-400 mx-auto mb-2"
                             fill="none"
                             viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        <p class="text-sm text-slate-500">Imagen no disponible</p>
                    </div>
                @endif
                <label for="product-image"
                       class="absolute top-3 right-3 px-3 py-2 bg-white rounded-md shadow-sm hover:bg-blue-50 focus:outline-none focus:ring-2 focus:ring-blue-500 cursor-pointer transition-all group">
                    <div class="flex items-center space-x-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-slate-600 group-hover:text-blue-600"
                             fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                        <span class="text-sm font-medium text-slate-700 group-hover:text-blue-700">Subir imagen</span>
                    </div>
                    <input
                        wire:model="newImage"
                        type="file"
                        id="product-image"
                        class="hidden"
                        accept="image/*">
                </label>
            </div>
        </div>
        <div class="mb-4">
            <x-label class="mb-2">
                Descripción
            </x-label>
            <textarea wire:model="description"
                      class="w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"></textarea>
        </div>
        <div class="mb-4">
            <x-label class="mb-2">
                SKU
            </x-label>
            <x-input
                wire:model="sku"
                step="1"
                min="0"
                onkeydown="return event.keyCode !== 190 && event.keyCode !== 110"
                type="number"
                class="w-full"
                placeholder="Ingrese el SKU del producto a crear"
            />
        </div>
        <div class="mb-4">
            <x-label class="mb-2">
                Precio
            </x-label>
            <x-input
                wire:model="price"
                type="number"
                step="0.01"
                min="0"
                class="w-full"
                placeholder="Ingrese el Precio del producto a crear"
            />
        </div>
        @empty($product->variants->count()>0)
        <div class="mb-4">
            <x-label class="mb-2">
                Stock
            </x-label>
            <x-input
                wire:model="stock"
                type="number"
                min="0"
                class="w-full"
                placeholder="Ingrese el Stock del producto a crear"
            />
        </div>
        @endempty
        <div class="mb-4">
            <x-label class="mb-2">
                Familia
            </x-label>
            <x-select class="w-full" wire:model.live="selectedFamilyId">
                <option value="">Selecciona una familia</option>
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
                <option value="">Selecciona una categoría</option>
                @foreach($this->categories as $category)
                    <option value="{{$category->id}}">
                        {{$category->name}}
                    </option>
                @endforeach
            </x-select>
        </div>
        <div class="mb-4">
            <x-label class="mb-2">
                Subcategoría
            </x-label>
            <x-select class="w-full" wire:model.live="selectedSubcategoryId">
                <option value="">Selecciona una subcategoría</option>
                @foreach($this->subcategories as $subcategory)
                    <option value="{{$subcategory->id}}">
                        {{$subcategory->name}}
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
        <x-validation-errors></x-validation-errors>
    </form>
    <form id="deleteForm" action="{{route('admin.products.destroy',$product)}}" method="post" class="hidden">
        @csrf
        @method('DELETE')
    </form>

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
