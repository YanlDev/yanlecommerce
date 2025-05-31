<x-app-layout>
    @push('css')
        <link
            rel="stylesheet"
            href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"
        />
    @endpush


    <!-- Slider main container -->
    <div class="swiper mb-4">
        <!-- Additional required wrapper -->
        <div class="swiper-wrapper">
            <!-- Slides -->
            @foreach($covers as $cover)
                <div class="swiper-slide">
                    <img src="{{$cover->image}}" class="w-full aspect-[3/1] object-cover object-center"
                         alt="portada de la web">
                </div>
            @endforeach
        </div>
        <!-- If we need pagination -->
        <div class="swiper-pagination"></div>

        <!-- If we need navigation buttons -->
        <div class="swiper-button-prev"></div>
        <div class="swiper-button-next"></div>

    </div>

    <x-container class="py-16 bg-gray-50">
        <div class="text-center mb-12">
            <h1 class="text-3xl font-bold text-gray-900 mb-2">
                Últimos Productos
            </h1>
            <p class="text-gray-600">
                Descubre nuestras últimas incorporaciones
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($lastProducts as $product)
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

        <!-- Botón para ver todos los productos -->
        <div class="text-center mt-12">
            <a href="#"
               class="inline-flex items-center px-6 py-3 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50 hover:border-gray-400 transition-all duration-200 font-medium">
                Ver todos los productos
                <i class="fas fa-arrow-right ml-2 text-sm"></i>
            </a>
        </div>
    </x-container>

    {{-- Agregar estos estilos CSS personalizados --}}
    <style>
        .line-clamp-1 {
            display: -webkit-box;
            -webkit-line-clamp: 1;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
    </style>


    @push('js')
        <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

        <script>
            const swiper = new Swiper('.swiper', {
                // Optional parameters
                loop: true,
                autoplay: {
                    delay: 5000,
                },

                // If we need pagination
                pagination: {
                    el: '.swiper-pagination',
                },

                // Navigation arrows
                navigation: {
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev',
                },

            });
        </script>

    @endpush
</x-app-layout>
