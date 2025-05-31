<div x-data="{
    open: false,
    closeMenu() {
        this.open = false;
    }
}"
     x-on:keydown.escape.window="closeMenu()">

    <header class="bg-white shadow-sm border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">

                <!-- Botón menú lateral -->
                <button
                    class="text-gray-700 p-2 rounded-md hover:bg-gray-100 focus:bg-gray-100 focus:outline-none transition-all duration-200"
                    x-on:click="open = !open"
                    :aria-expanded="open"
                    aria-label="Menú de navegación"
                >
                    <i class="fas fa-bars text-xl" x-show="!open"></i>
                    <i class="fas fa-times text-xl" x-show="open"></i>
                </button>

                <!-- Logo minimalista -->
                <div class="flex items-center">
                    <a href="/" class="flex items-center group">
                        <div
                            class="bg-gray-900 p-2 rounded-md mr-3 group-hover:bg-gray-800 transition-all duration-200">
                            <i class="fas fa-shopping-bag text-white text-lg"></i>
                        </div>
                        <div>
                            <h1 class="text-gray-900 text-xl font-semibold group-hover:text-gray-700 transition-colors">
                                YanIDev
                            </h1>
                            <span class="text-gray-500 text-xs font-medium">
                                Ecommerce
                            </span>
                        </div>
                    </a>
                </div>

                <!-- Barra de búsqueda minimalista -->
                <div class="hidden md:flex flex-1 max-w-xl mx-8">
                    <div class="relative w-full">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-search text-gray-400 text-sm"></i>
                        </div>
                        <input
                            type="search"
                            class="w-full pl-10 pr-4 py-2 bg-gray-50 border border-gray-200 rounded-md focus:ring-1 focus:ring-gray-900 focus:border-gray-900 focus:outline-none transition-all placeholder-gray-500 text-gray-900 text-sm"
                            placeholder="Buscar productos..."
                            aria-label="Buscar productos"
                        />
                    </div>
                </div>

                <!-- Iconos de usuario minimalistas -->
                <div class="flex items-center space-x-1">

                    <!-- Dropdown de usuario minimalista -->
                    <x-dropdown>
                        <x-slot name="trigger">
                            @auth
                                <button
                                    class="flex items-center text-gray-700 p-2 rounded-md hover:bg-gray-100 focus:bg-gray-100 focus:outline-none transition-all duration-200">
                                    <img class="size-8 rounded-full object-cover border border-gray-200"
                                         src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}"/>
                                    <div class="hidden sm:block text-left ml-2">
                                        <div class="text-sm font-medium text-gray-900">{{ Auth::user()->name }}</div>
                                        <div class="text-xs text-gray-500">Mi cuenta</div>
                                    </div>
                                </button>
                            @else
                                <button
                                    class="flex items-center text-gray-700 p-2 rounded-md hover:bg-gray-100 focus:bg-gray-100 focus:outline-none transition-all duration-200"
                                    aria-label="Mi cuenta"
                                >
                                    <div class="bg-gray-100 p-2 rounded-md mr-2">
                                        <i class="fas fa-user text-gray-600 text-sm"></i>
                                    </div>
                                    <div class="hidden sm:block text-left">
                                        <div class="text-sm font-medium text-gray-900">Mi Cuenta</div>
                                        <div class="text-xs text-gray-500">Iniciar sesión</div>
                                    </div>
                                </button>
                            @endauth
                        </x-slot>

                        <x-slot name="content">
                            @guest
                                <div class="px-4 py-4">
                                    <div class="flex justify-center mb-4">
                                        <a href="{{route('login')}}"
                                           class="bg-gray-900 text-white px-4 py-2 rounded-md hover:bg-gray-800 transition-all duration-200 font-medium text-sm">
                                            Iniciar sesión
                                        </a>
                                    </div>
                                    <p class="text-sm text-center text-gray-600">
                                        ¿No tienes cuenta?
                                        <a href="{{route('register')}}"
                                           class="text-gray-900 hover:text-gray-700 font-medium">Regístrate</a>
                                    </p>
                                </div>
                            @else
                                <x-dropdown-link href="{{ route('profile.show') }}">
                                    <i class="fas fa-user mr-2 text-gray-400"></i>
                                    Mi Perfil
                                </x-dropdown-link>
                                <div class="border-t border-gray-200"></div>
                                <form method="POST" action="{{ route('logout') }}" x-data>
                                    @csrf
                                    <x-dropdown-link href="{{ route('logout') }}"
                                                     @click.prevent="$root.submit();">
                                        <i class="fas fa-sign-out-alt mr-2 text-gray-400"></i>
                                        {{ __('Cerrar Sesión') }}
                                    </x-dropdown-link>
                                </form>
                            @endguest
                        </x-slot>
                    </x-dropdown>

                    <!-- Carrito minimalista -->
                    <button
                        class="flex items-center text-gray-700 p-2 rounded-md hover:bg-gray-100 focus:bg-gray-100 focus:outline-none transition-all duration-200 relative">
                        <div class="bg-gray-100 p-2 rounded-md mr-2">
                            <i class="fas fa-shopping-cart text-gray-600 text-sm"></i>
                        </div>
                        <div class="hidden sm:block text-left">
                            <div class="text-sm font-medium text-gray-900">Carrito</div>
                            <div class="text-xs text-gray-500">0 artículos</div>
                        </div>
                        <span
                            class="absolute top-1 -right-1 bg-red-500 text-white text-xs rounded-full h-4 w-4 flex items-center justify-center ">0</span>
                    </button>
                </div>
            </div>

            <!-- Barra de búsqueda móvil -->
            <div class="md:hidden pb-4">
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fas fa-search text-gray-400 text-sm"></i>
                    </div>
                    <input
                        type="search"
                        class="w-full pl-10 pr-4 py-2 bg-gray-50 border border-gray-200 rounded-md focus:ring-1 focus:ring-gray-900 focus:border-gray-900 focus:outline-none placeholder-gray-500 text-gray-900 text-sm"
                        placeholder="Buscar productos..."
                        aria-label="Buscar productos"
                    />
                </div>
            </div>
        </div>
    </header>

    <!-- Overlay minimalista -->
    <div
        x-show="open"
        x-transition:enter="transition-opacity ease-out duration-300"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition-opacity ease-in duration-200"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        x-on:click="closeMenu()"
        class="fixed inset-0 bg-black bg-opacity-25 z-40"
        style="display: none"
    ></div>

    <!-- Menú lateral minimalista -->
    <div
        x-show="open"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="-translate-x-full"
        x-transition:enter-end="translate-x-0"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="translate-x-0"
        x-transition:leave-end="-translate-x-full"
        class="fixed top-0 left-0 z-50"
        style="display: none"
    >
        <div class="flex h-screen">
            <!-- Panel principal -->
            <div class="w-80 h-full bg-white shadow-xl border-r border-gray-200">
                <!-- Header del menú -->
                <div class="bg-gray-50 border-b border-gray-200 p-4">
                    <div class="flex justify-between items-center">
                        <div class="flex items-center">
                            <div class="bg-gray-900 p-2 rounded-md mr-3">
                                <i class="fas fa-bars text-white text-sm"></i>
                            </div>
                            <div>
                                <span class="text-lg font-semibold text-gray-900">Categorías</span>
                                <div class="text-sm text-gray-500">Explora nuestros productos</div>
                            </div>
                        </div>
                        <button
                            x-on:click="closeMenu()"
                            class="p-2 rounded-md hover:bg-gray-200 focus:bg-gray-200 focus:outline-none transition-colors"
                            aria-label="Cerrar menú"
                        >
                            <i class="fas fa-times text-gray-600"></i>
                        </button>
                    </div>
                </div>

                <!-- Lista de familias -->
                <div class="h-[calc(100%-80px)] overflow-auto">
                    <nav role="navigation" aria-label="Categorías principales" class="p-2">
                        <ul class="space-y-1">
                            @foreach($families as $family)
                                <li wire:mouseover="$set('family_id', {{$family->id}})">
                                    <a href="{{route('families.show', $family)}}"
                                       class="flex items-center justify-between p-3 text-gray-700 hover:bg-gray-50 hover:text-gray-900 focus:bg-gray-50 focus:text-gray-900 focus:outline-none transition-all rounded-md border-l-4 border-transparent hover:border-gray-900"
                                    >
                                        <div class="flex items-center">
                                            <span class="font-medium">{{$family->name}}</span>
                                        </div>
                                        <i class="fas fa-chevron-right text-gray-400 text-sm"></i>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </nav>
                </div>
            </div>

            <!-- Panel de subcategorías (desktop) -->
            <div class="hidden md:block w-96 h-full bg-gray-50 border-r border-gray-200">
                <div class="p-6 h-full overflow-auto">
                    <div class="mb-6 flex justify-between items-center">
                        <h3 class="text-lg font-semibold text-gray-900 border-b-2 border-gray-900 pb-1 uppercase tracking-wide">
                            {{$this->familyName}}
                        </h3>
                        <a href="{{route('families.show', $family_id)}}"
                           class="px-3 py-1 bg-gray-900 text-white rounded-md hover:bg-gray-800 focus:bg-gray-800 focus:outline-none transition-all text-sm font-medium">
                            Ver todo
                        </a>
                    </div>
                    <ul class="space-y-6">
                        @foreach($this->categories as $category)
                            <li>
                                <a href=""
                                   class="text-gray-900 font-semibold text-base hover:text-gray-700 focus:text-gray-700 focus:outline-none transition-colors flex items-center mb-3">
                                    {{$category->name}}
                                </a>
                                <ul class="space-y-2 ml-4">
                                    @foreach($category->subcategories as $subcategory)
                                        <li>
                                            <a href=""
                                               class="block text-sm text-gray-600 hover:text-gray-900 focus:text-gray-900 focus:outline-none transition-colors pl-2 border-l-2 border-transparent hover:border-gray-300 py-1">
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
