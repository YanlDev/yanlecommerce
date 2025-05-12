<x-admin-layout :breadcrumbs="[
    [
        'name' => 'Dashboard',
        'route' => route('admin.dashboard')
    ],
    [
        'name' => 'Productos',
    ]
]"
                {{--BOTON DE ACCION POR SI SE VA CREAR ALGO NUEVO EN ESA RUTA--}}
                :actionLink="route('admin.products.create')"
>
    <x-data-table
        :columnsTable="['ID','SKU','Nombre','Precio','Acción']"
        :rows="$products"
        :fields="['id', 'sku','name','price']"
        routeEdit="admin.products.edit"
    ></x-data-table>

</x-admin-layout>
