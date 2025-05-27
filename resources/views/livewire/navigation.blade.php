<div x-data="{
    open: false,
    closeMenu() {
        this.open = false;
    }
}"
     x-on:keydown.escape.window="closeMenu()">

    <header class="bg-zinc-800">
        <div class="container mx-auto px-4 py-2">
            <div class="flex justify-between space-x-8 items-center">

                <button
                    class="text-2xl p-2 rounded-md hover:bg-zinc-700 focus:bg-zinc-700 focus:outline-none focus:ring-2 focus:ring-white transition-colors"
                    x-on:click="open = !open"
                    :aria-expanded="open"
                    aria-label="Menú de navegación"
                >
                    <i class="fas fa-bars text-white" x-show="!open"></i>
                    <i class="fas fa-times text-white" x-show="open"></i>
                </button>

                <!-- Logo mejorado -->
                <a href="/" class="inline-flex flex-col items-end group">
                    <h1 class="text-white text-2xl md:text-3xl font-semibold leading-6 group-hover:text-indigo-300 transition-colors">
                        YanIDev
                    </h1>
                    <span class="text-xs text-white group-hover:text-indigo-200 transition-colors">
                        Ecommerce
                    </span>
                </a>

                <!-- Barra de búsqueda desktop -->
                <div class="flex-1 hidden md:block">
                    <div class="relative">
                        <input
                            type="search"
                            class="w-full px-4 py-2 pl-10 rounded-md bg-white text-gray-800 placeholder-gray-500 focus:ring-2 focus:ring-indigo-500 focus:outline-none transition-all"
                            placeholder="Buscar por producto, tienda o marca"
                            aria-label="Buscar productos"
                        />
                        <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                    </div>
                </div>

                <!-- Iconos de usuario mejorados -->
                <div class="flex items-center space-x-4">

                    <x-dropdown>
                        <x-slot name="trigger">

                            @auth
                                <button
                                    class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition">
                                    <img class="size-8 rounded-full object-cover"
                                         src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}"/>
                                </button>
                            @else
                                <button
                                    class="text-2xl md:text-3xl p-2 rounded-md hover:bg-zinc-700 focus:bg-zinc-700 focus:outline-none focus:ring-2 focus:ring-white transition-colors"
                                    aria-label="Mi cuenta"
                                >
                                    <i class="fas fa-user text-white"></i>
                                </button>
                            @endauth

                        </x-slot>
                        <x-slot name="content">
                            {{-- Si no inicio session muestra eso --}}
                            @guest
                                <div class="px-4 py-2">
                                    <div class="flex justify-center">
                                        <a href="{{route('login')}}" class="btn-zinc">
                                            Iniciar sesión
                                        </a>
                                    </div>
                                    <p class="text-sm text-center mt-2">
                                        ¿No tienes cuenta?
                                        <a href="{{route('register')}}"
                                           class="text-zinc-700 hover:underline">Registrate</a>
                                    </p>
                                </div>
                            @else
                                <x-dropdown-link href="{{ route('profile.show') }}">
                                    Mi Perfil
                                </x-dropdown-link>
                                <div class="border-t border-gray-200"></div>
                                <form method="POST" action="{{ route('logout') }}" x-data>
                                    @csrf

                                    <x-dropdown-link href="{{ route('logout') }}"
                                                     @click.prevent="$root.submit();">
                                        {{ __('Log Out') }}
                                    </x-dropdown-link>
                                </form>
                            @endguest
                        </x-slot>
                    </x-dropdown>

                    <button
                        class="text-2xl md:text-3xl p-2 rounded-md hover:bg-zinc-700 focus:bg-zinc-700 focus:outline-none focus:ring-2 focus:ring-white transition-colors relative"
                        aria-label="Carrito de compras"
                    >
                        <i class="fas fa-shopping-cart text-white"></i>
                    </button>
                </div>
            </div>

            <!-- Barra de búsqueda móvil -->
            <div class="mt-4">
                <input
                    type="search"
                    class="w-full md:hidden px-4 py-2 rounded-md bg-white text-gray-800 placeholder-gray-500 focus:ring-2 focus:ring-indigo-500 focus:outline-none"
                    placeholder="Buscar por producto, tienda o marca"
                    aria-label="Buscar productos"
                />
            </div>
        </div>
    </header>

    <!-- Overlay mejorado -->
    <div
        x-show="open"
        x-transition:enter="transition-opacity ease-out duration-300"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition-opacity ease-in duration-200"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        x-on:click="closeMenu()"
        class="fixed top-0 left-0 inset-0 bg-black bg-opacity-25 z-10"
        style="display: none"
    ></div>

    <!-- Menú lateral mejorado -->
    <div
        x-show="open"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="-translate-x-full"
        x-transition:enter-end="translate-x-0"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="translate-x-0"
        x-transition:leave-end="-translate-x-full"
        class="fixed top-0 left-0 z-20"
        style="display: none"
    >
        <div class="flex">
            <!-- Panel principal -->
            <div class="w-screen md:w-80 h-screen bg-white">
                <!-- Header del menú -->
                <div class="px-4 py-3 bg-zinc-800 text-white font-semibold">
                    <div class="flex justify-between items-center">
                        <span class="text-lg">
                            Hola
                        </span>
                        <button
                            x-on:click="closeMenu()"
                            class="p-1 rounded hover:bg-zinc-700 focus:bg-zinc-700 focus:outline-none focus:ring-2 focus:ring-white transition-colors"
                            aria-label="Cerrar menú"
                        >
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>

                <!-- Lista de familias -->
                <div class="h-[calc(100vh-52px)] overflow-auto">
                    <nav role="navigation" aria-label="Categorías principales">
                        <ul>
                            @foreach($families as $family)
                                <li wire:mouseover="$set('family_id', {{$family->id}})">
                                    <a href=""
                                       class="p-4 text-zinc-800 hover:bg-indigo-50 hover:text-indigo-600 focus:bg-indigo-50 focus:text-indigo-600 focus:outline-none transition-colors flex justify-between items-center border-l-4 border-transparent hover:border-indigo-500"
                                    >
                                        {{$family->name}}
                                        <i class="fa-solid fa-angle-right text-gray-400"></i>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </nav>
                </div>
            </div>

            <!-- Panel de subcategorías (desktop) -->
            <div class="w-80 xl:w-[57rem] pt-[52px] hidden md:block">
                <div class="h-[calc(100vh-52px)] overflow-auto bg-white px-6 py-8">
                    <div class="mb-6 flex justify-between items-center gap-2">
                        <p class="border-b-[3px] border-indigo-500 uppercase text-xl font-semibold text-gray-800">
                            {{$this->familyName}}
                        </p>
                        <a href="#"
                           class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 focus:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 transition-colors text-sm">
                            Ver todo
                        </a>
                    </div>
                    <ul class="grid grid-cols-1 xl:grid-cols-3 gap-8">
                        @foreach($this->categories as $category)
                            <li>
                                <a href=""
                                   class="text-zinc-800 font-semibold text-md hover:text-indigo-600 focus:text-indigo-600 focus:outline-none transition-colors">
                                    {{$category->name}}
                                </a>
                                <ul class="mt-4 space-y-2">
                                    @foreach($category->subcategories as $subcategory)
                                        <li>
                                            <a href=""
                                               class="block text-sm text-zinc-500 hover:text-indigo-600 focus:text-indigo-600 focus:outline-none transition-colors pl-2 border-l-2 border-transparent hover:border-indigo-300">
                                                {{$subcategory->name}}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
