<x-admin-layout :breadcrumbs="[
    [
        'name' => 'Dashboard',
        'route' => route('admin.dashboard')
    ],
    [
        'name' => 'Categorías',
    ]
]"
                {{--BOTON DE ACCION POR SI SE VA CREAR ALGO NUEVO EN ESA RUTA--}}
                :actionLink="route('admin.categories.create')"
>
    <x-data-table
        :columnsTable="['ID','Categoría','Familia','Acción']"
        :rows="$categories"
        :fields="['id','name','family.name']"
        routeEdit="admin.categories.edit"
    />


</x-admin-layout>
