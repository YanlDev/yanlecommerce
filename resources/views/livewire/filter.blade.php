<!-- Tu componente actual con script corregido -->
<div class="bg-gray-50 py-8">
    <x-container class="flex flex-col lg:flex-row gap-6">
        <!-- Sidebar de filtros -->
        @if(count($options))
            <aside class="w-full lg:w-64 xl:w-72 bg-white rounded-lg shadow-sm border border-gray-200 p-6 h-fit">
                <!-- Título del filtro -->
                <div class="mb-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">Filtros</h3>
                    <div class="h-px bg-gray-200"></div>
                </div>

                <!-- Botón para mobile (toggle filtros) -->
                <button id="mobile-filter-toggle"
                        class="lg:hidden w-full mb-4 px-4 py-2 bg-gray-100 text-gray-700 rounded-md flex items-center justify-between hover:bg-gray-200 transition-colors">
                    <span id="filter-text">Mostrar filtros</span>
                    <i id="filter-icon" class="fa-solid fa-filter"></i>
                </button>

                <!-- Lista de filtros -->
                <div id="filters-container" class="space-y-4 hidden lg:block" x-data="{ openFilters: {} }">
                    @foreach($options as $index => $option)
                        <div class="border-b border-gray-100 last:border-b-0 pb-4 last:pb-0">
                            <!-- Encabezado del filtro -->
                            <button
                                @click="openFilters[{{ $index }}] = !openFilters[{{ $index }}]"
                                class="w-full px-3 py-2 bg-gray-50 hover:bg-gray-100 rounded-md text-left text-gray-800 font-medium flex justify-between items-center transition-colors group">
                                <span>{{ $option['name'] }}</span>
                                <i class="fa-solid fa-chevron-down transform transition-transform duration-200"
                                   :class="{ 'rotate-180': openFilters[{{ $index }}] }"></i>
                            </button>

                            <!-- Opciones del filtro -->
                            <div x-show="openFilters[{{ $index }}]"
                                 x-transition:enter="transition ease-out duration-200"
                                 x-transition:enter-start="opacity-0 transform scale-95"
                                 x-transition:enter-end="opacity-100 transform scale-100"
                                 x-transition:leave="transition ease-in duration-150"
                                 x-transition:leave-start="opacity-100 transform scale-100"
                                 x-transition:leave-end="opacity-0 transform scale-95"
                                 class="mt-3 space-y-2 pl-2">
                                @foreach($option['features'] as $feature)
                                    <label
                                        class="flex items-center group cursor-pointer hover:bg-gray-50 p-2 rounded-md transition-colors">
                                        <input type="checkbox"
                                               class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 focus:ring-2 mr-3"
                                               name="{{ $option['name'] }}[]"
                                               wire:model.live="selected_features"
                                               value="{{ $feature['id'] }}">
                                        <span class="text-sm text-gray-700 group-hover:text-gray-900 select-none">
                                        {{ $feature['description'] }}
                                    </span>
                                    </label>
                                @endforeach
                            </div>
                        </div>
                    @endforeach

                    <!-- Botones de acción -->
                    <div class="mt-6 pt-4 border-t border-gray-200 space-y-2">
                        <button id="apply-filters"
                                class="w-full px-4 py-2 bg-black text-white rounded-md hover:bg-black transition-colors font-medium">
                            Aplicar Filtros
                        </button>
                        <button id="clear-filters"
                                class="w-full px-4 py-2 bg-gray-100 text-gray-700 rounded-md hover:bg-gray-200 transition-colors">
                            Limpiar Filtros
                        </button>
                    </div>
                </div>
            </aside>
        @endif


        <!-- Área de productos -->
        <div class="flex-1 min-h-96">
            <!-- Header de productos -->
            <div
                class="bg-white rounded-lg shadow-sm border border-gray-200 p-4 mb-6 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                <div>
                    <h2 class="text-xl font-semibold text-gray-900">Productos</h2>
                    <p class="text-sm text-gray-600">Mostrando resultados filtrados</p>
                </div>

                <!-- Ordenamiento -->
                <select
                    class="px-3 py-2 border border-gray-300 rounded-md text-sm focus:ring-blue-500 focus:border-blue-500">
                    <option>Ordenar por</option>
                    <option>Precio: Menor a Mayor</option>
                    <option>Precio: Mayor a Menor</option>
                    <option>Más Populares</option>
                    <option>Más Recientes</option>
                </select>
            </div>

            <!-- Grid de productos -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($products as $product)
                    <div
                        class="bg-white rounded-lg border border-gray-200 hover:border-gray-300 hover:shadow-md transition-all duration-200 overflow-hidden group">

                        <!-- Imagen del producto -->
                        <div class="relative overflow-hidden">
                            <img
                                src="{{$product->image}}"
                                alt="{{$product->name}}"
                                class="w-full h-48 object-contain group-hover:scale-105 transition-transform duration-300"
                            />
                            <!-- Overlay sutil para mejorar contraste -->
                            <div
                                class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-5 transition-all duration-300"></div>

                            <!-- Badge opcional para ofertas con mejor contraste -->
                            {{-- <div class="absolute top-3 left-3 bg-black bg-opacity-80 text-white px-3 py-1 rounded-full text-xs font-medium backdrop-blur-sm">
                                Nuevo
                            </div> --}}
                        </div>

                        <!-- Contenido de la card -->
                        <div class="p-6 flex flex-col h-40">

                            <!-- Título del producto -->
                            <h3 class="text-lg font-semibold text-gray-900 mb-2 line-clamp-1">
                                {{$product->name}}
                            </h3>

                            <!-- Descripción truncada -->
                            <p class="text-gray-600 text-sm mb-4 flex-1 line-clamp-2">
                                {{ Str::limit($product->description, 80, '...') }}
                            </p>

                            <!-- Precio y botón -->
                            <div class="flex items-center justify-between mt-auto">
                                <div class="flex flex-col">
                            <span class="text-xl font-bold text-gray-900">
                                S/. {{ number_format($product->price, 2) }}
                            </span>
                                </div>

                                <button
                                    class="bg-gray-900 hover:bg-gray-800 text-white px-4 py-2 rounded-md text-sm font-medium transition-colors duration-200 flex items-center group/btn">
                                    Ver más
                                    <i class="fas fa-arrow-right ml-2 text-xs group-hover/btn:translate-x-1 transition-transform duration-200"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="mt-8">
                {{$products->links()}}
            </div>
{{--            @dump($selected_features)--}}
        </div>
    </x-container>
</div>

<!-- Script JavaScript corregido -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Elementos del DOM
        const filterToggle = document.getElementById('mobile-filter-toggle');
        const filtersContainer = document.getElementById('filters-container');
        const filterText = document.getElementById('filter-text');
        const filterIcon = document.getElementById('filter-icon');
        const applyButton = document.getElementById('apply-filters');
        const clearButton = document.getElementById('clear-filters');

        // Toggle filtros en mobile
        if (filterToggle && filtersContainer) {
            filterToggle.addEventListener('click', function () {
                const isHidden = filtersContainer.classList.contains('hidden');

                if (isHidden) {
                    // Mostrar filtros
                    filtersContainer.classList.remove('hidden');
                    filterText.textContent = 'Ocultar filtros';
                    filterIcon.className = 'fa-solid fa-times';
                } else {
                    // Ocultar filtros
                    filtersContainer.classList.add('hidden');
                    filterText.textContent = 'Mostrar filtros';
                    filterIcon.className = 'fa-solid fa-filter';
                }
            });
        }

        // Aplicar filtros
        if (applyButton) {
            applyButton.addEventListener('click', function () {
                const selectedFilters = [];

                // Obtener todos los checkboxes marcados
                document.querySelectorAll('input[type="checkbox"]:checked').forEach(checkbox => {
                    selectedFilters.push({
                        name: checkbox.name,
                        value: checkbox.value
                    });
                });

                console.log('Filtros aplicados:', selectedFilters);

                // Aquí harías la llamada AJAX o filtrado
                // filterProducts(selectedFilters);

                // En mobile, ocultar filtros después de aplicar
                if (window.innerWidth < 1024) {
                    filtersContainer.classList.add('hidden');
                    filterText.textContent = 'Mostrar filtros';
                    filterIcon.className = 'fa-solid fa-filter';
                }
            });
        }

        // Limpiar filtros
        if (clearButton) {
            clearButton.addEventListener('click', function () {
                // Desmarcar todos los checkboxes
                document.querySelectorAll('input[type="checkbox"]').forEach(checkbox => {
                    checkbox.checked = false;
                });

                console.log('Filtros limpiados');
            });
        }

        // Comportamiento responsive
        window.addEventListener('resize', function () {
            if (window.innerWidth >= 1024) {
                // En desktop, siempre mostrar filtros
                filtersContainer.classList.remove('hidden');
            } else {
                // En mobile, mantener estado actual
                // No forzar ocultar para no interrumpir al usuario
            }
        });
    });
</script>
