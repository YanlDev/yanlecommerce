<x-admin-layout :breadcrumbs="[
    [
        'name' => 'Dashboard',
        'route' => route('admin.dashboard')
    ],
    [
        'name' => 'Subcategorías',
        'route' => route('admin.subcategories.index')
    ],
    [
        'name' => 'Crear'
    ]
]"

    {{--BOTON DE ACCION POR SI SE VA CREAR ALGO NUEVO EN ESA RUTA--}}
    {{--                :actionLink="route('admin.subcategories.create')"--}}

>
    @livewire("admin.subcategories.create-subcategory")
</x-admin-layout>
