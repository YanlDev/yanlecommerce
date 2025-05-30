<x-admin-layout :breadcrumbs="[
    [
        'name' => 'Dashboard',
        'route' => route('admin.dashboard')
    ],
    [
        'name' => 'Familias',
    ]
]"
                {{--BOTON DE ACCION POR SI SE VA CREAR ALGO NUEVO EN ESA RUTA--}}
                :actionLink="route('admin.families.create')"
>

    <x-data-table
        :columnsTable="['ID', 'Familia', 'Acción']"
        :rows="$families"
        :fields="['id', 'name']"
        routeEdit="admin.families.edit"
    ></x-data-table>

</x-admin-layout>
