<?php
$links = [
    [
        'icon' => 'fa-solid fa-gauge',
        'name' => 'Dashboard',
        'url' => route('admin.dashboard'),
        'active' => request()->routeIs('admin.dashboard')
    ],
    [
        'icon' => 'fa-solid fa-gears',
        'name' => 'Opciones',
        'url' => route('admin.options.index'),
        'active' => request()->routeIs('admin.options.*')
    ],
    [
        'icon' => 'fa-solid fa-boxes-stacked',
        'name' => 'Familias',
        'url' => route('admin.families.index'),
        'active' => request()->routeIs('admin.families.*')
    ],
    [
        'icon' => 'fa-solid fa-tag',
        'name' => 'Categorías',
        'url' => route('admin.categories.index'),
        'active' => request()->routeIs('admin.categories.*')
    ],
    [
        'icon' => 'fa-solid fa-tags',
        'name' => 'Subcategorías',
        'url' => route('admin.subcategories.index'),
        'active' => request()->routeIs('admin.subcategories.*')
    ],
    [
        'icon' => 'fa-solid fa-box-open',
        'name' => 'Productos',
        'url' => route('admin.products.index'),
        'active' => request()->routeIs('admin.products.*')
    ]


]

?>

    <!-- Sidebar -->
<aside id="logo-sidebar"
       :class="{
        'translate-x-0 ease-out': sidebarOpen,
        '-translate-x-full ease-in': !sidebarOpen
       }"
       class="fixed top-0 left-0 z-40 w-64 h-screen pt-20 transition-transform bg-white border-r border-gray-200 sm:translate-x-0"
       aria-label="Sidebar">
    <div class="h-full px-3 pb-4 overflow-y-auto bg-white">
        <ul class="space-y-2 font-medium">
            @foreach($links as $link)
                <li>
                    <a
                        href="{{$link['url']}}"
                        class="flex items-center p-2 text-gray-900 rounded-lg hover:bg-gray-100 group {{ $link['active'] ? 'bg-gray-200 ' : '' }}"
                    >
                        <span class="inline-flex w-6 h-6 items-center justify-center text-gray-900">
                        <i class="{{$link['icon']}}"></i>
                        </span>
                        <span class="ms-3">{{$link['name']}}</span>
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
</aside>

{{--<!-- Script para manejar la funcionalidad del sidebar -->--}}
{{--<script>--}}
{{--    // Asegúrate de que este código se ejecute después de que el DOM esté cargado--}}
{{--    document.addEventListener('DOMContentLoaded', function() {--}}
{{--        const sidebarToggle = document.querySelector('[data-drawer-toggle="logo-sidebar"]');--}}
{{--        const sidebar = document.getElementById('logo-sidebar');--}}

{{--        if (sidebarToggle && sidebar) {--}}
{{--            sidebarToggle.addEventListener('click', function() {--}}
{{--                sidebar.classList.toggle('-translate-x-full');--}}
{{--            });--}}
{{--        }--}}

{{--        // Para el dropdown del usuario--}}
{{--        const userDropdownToggle = document.querySelector('[data-dropdown-toggle="dropdown-user"]');--}}
{{--        const userDropdownMenu = document.getElementById('dropdown-user');--}}

{{--        if (userDropdownToggle && userDropdownMenu) {--}}
{{--            userDropdownToggle.addEventListener('click', function() {--}}
{{--                userDropdownMenu.classList.toggle('hidden');--}}
{{--            });--}}

{{--            // Cerrar dropdown cuando se hace clic fuera--}}
{{--            document.addEventListener('click', function(event) {--}}
{{--                if (!userDropdownToggle.contains(event.target) && !userDropdownMenu.contains(event.target)) {--}}
{{--                    userDropdownMenu.classList.add('hidden');--}}
{{--                }--}}
{{--            });--}}
{{--        }--}}
{{--    });--}}
{{--</script>--}}
