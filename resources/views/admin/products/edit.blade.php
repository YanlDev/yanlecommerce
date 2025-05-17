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
        'name' => 'Editar'
    ]
]"
    {{--BOTON DE ACCION POR SI SE VA CREAR ALGO NUEVO EN ESA RUTA--}}
    {{--                :actionLink="route('admin.products.create')"--}}
>
    <div class="mb-4">
        @livewire('admin.products.edit-product', ['product' => $product], key('edit-product'.$product->id) )
    </div>

    @livewire('admin.products.variant-product',['product' => $product], key('variant-product'.$product->id))

</x-admin-layout>
