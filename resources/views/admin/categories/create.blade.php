<x-admin-layout :breadcrumbs="[
    [
        'name' => 'Dashboard',
        'route' => route('admin.dashboard')
    ],
    [
        'name' => 'Categorías',
        'route' => route('admin.categories.index')
    ],
    [
        'name' => 'Crear'
    ]
]"
    {{--BOTON DE ACCION POR SI SE VA CREAR ALGO NUEVO EN ESA RUTA--}}
    {{--                :actionLink="route('admin.categories.create')"--}}
>

    <div class="card">
        <form action="{{route('admin.categories.store')}}" method="POST">
            @csrf
            <div class="mb-2">
                <x-label class="mb-2">
                    Categoría
                </x-label>
                <x-input class="w-full" placeholder="Ingrese el nombre de la categorías a crear"
                         value="{{ old('name') }}" name="name">
                </x-input>
            </div>
            <div class="mb-4">
                <x-label class="mb-2">
                    Familias
                </x-label>
                <select name="family_id"
                        class='w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm'>
                    <option value="" selected disabled>Seleccione una familia</option>
                    @foreach($families as $family)
                        <option value="{{$family->id}}">
                            {{$family->name}}
                        </option>
                    @endforeach
                </select>
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
