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

    <x-container>
        <h1 class="text-2xl font-bold text-zinc-800 mb-4">
            Últimos Productos
        </h1>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

            @foreach($lastProducts as $product)
                <div
                    class="bg-white rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300 overflow-hidden">

                    <div class="relative">
                        <img
                            src="{{$product->image}}"
                            alt="Product Name"
                            class="w-full h-48 object-cover"
                        />
                    </div>


                    <div class="p-4">

                        <h3 class="text-lg font-semibold text-gray-800 mb-2">
                            {{$product->name}}
                        </h3>


                        <p class="text-gray-600 text-sm mb-4">
                            {{$product->description}}
                        </p>


                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-2">
                                <span class="text-xl font-bold text-gray-900">
                                  {{'S/. '.$product->price}}
                                </span>
                            </div>

                            <button
                                class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md text-sm font-medium transition-colors duration-200">
                                Ver más
                            </button>
                        </div>
                    </div>
                </div>
            @endforeach


        </div>
    </x-container>


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
