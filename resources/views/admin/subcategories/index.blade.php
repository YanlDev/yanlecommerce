<x-admin-layout :breadcrumbs="[
    [
        'name' => 'Dashboard',
        'route' => route('admin.dashboard')
    ],
    [
        'name' => 'Subcategorías',
    ]
]"
                {{--BOTON DE ACCION POR SI SE VA CREAR ALGO NUEVO EN ESA RUTA--}}
                :actionLink="route('admin.subcategories.create')"
>

    <x-data-table
        :columnsTable="['ID','Subcategoría','Categoría', 'Familia', 'Acción']"
        :rows="$subcategories"
        :fields="['id', 'name','category.name','category.family.name']"
        routeEdit="admin.subcategories.edit"
    ></x-data-table>


</x-admin-layout>
