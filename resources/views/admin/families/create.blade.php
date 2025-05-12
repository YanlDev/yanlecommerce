<x-admin-layout :breadcrumbs="[
    [
        'name' => 'Dashboard',
        'route' => route('admin.dashboard')
    ],
    [
        'name' => 'Familias',
        'route' => route('admin.families.index')
    ],
    [
        'name' => 'Crear'
    ]
]"
                {{--BOTON DE ACCION POR SI SE VA CREAR ALGO NUEVO EN ESA RUTA--}}
{{--                :actionLink="route('admin.families.create')"--}}
>
    <div class="card">
        <form action="{{route('admin.families.store')}}" method="POST">
            @csrf
            <div class="mb-2">
                <x-label class="mb-2">
                    Familia
                </x-label>
                <x-input class="w-full" placeholder="Ingrese el nombre de la familia a crear" value="" name="name">
                </x-input>
            </div>
            <div class="flex justify-end mb-2">
                <button type="submit" class="btn-green">
                    Registrar
                </button>
            </div>
        </form>
        <x-validation-errors></x-validation-errors>
    </div>
</x-admin-layout>
