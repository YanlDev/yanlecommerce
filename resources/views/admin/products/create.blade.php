<x-admin-layout :breadcrumbs="[
    [
        'name' => 'Dashboard',
        'route' => route('admin.dashboard')
    ],
    [
        'name' => 'Productos',
        'route' => route('admin.products.index')
    ],
    [
        'name' => 'Crear'
    ]
]"
                {{--BOTON DE ACCION POR SI SE VA CREAR ALGO NUEVO EN ESA RUTA--}}
{{--                :actionLink="route('admin.products.create')"--}}
>
    @livewire('admin.products.create-product')

</x-admin-layout>
