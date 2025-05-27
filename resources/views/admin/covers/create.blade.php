<x-admin-layout :breadcrumbs="[
    [
        'name' => 'Dashboard',
        'route' => route('admin.dashboard')
    ],
    [
        'name' => 'Portadas',
        'route'=> route('admin.covers.index')
    ],
    [
        'name' => 'Crear Portada'
    ]
]"
    {{--BOTON DE ACCION POR SI SE VA CREAR ALGO NUEVO EN ESA RUTA--}}
    {{--                :actionLink="route('admin.covers.create')"--}}
>

    {{--    <x-data-table--}}
    {{--        :columnsTable="['ID', 'Familia', 'Acción']"--}}
    {{--        :rows="$families"--}}
    {{--        :fields="['id', 'name']"--}}
    {{--        routeEdit="admin.families.edit"--}}
    {{--    ></x-data-table>--}}

    <form action="{{route('admin.cover.create')}}" method="POST">
        @csrf

        <figure>
            <img src="" alt="">
        </figure>


    </form>


</x-admin-layout>
