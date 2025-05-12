<x-admin-layout :breadcrumbs="[
    [
        'name' => 'Dashboard',
        'route' => route('admin.dashboard')
    ],
    [
        'name' => 'Categorías',
        'route'=> route('admin.categories.index')
    ],
    [
        'name'=>'Editar'
    ]
]">

    <div class="card">
        <form action="{{route('admin.categories.update', $category)}}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-2">
                <x-label class="mb-2">
                    Categoría
                </x-label>
                <x-input class="w-full" placeholder="Ingrese el nombre de la categorías a crear"
                         value="{{ old('name', $category->name) }}" name="name">
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
                        <option value="{{$family->id}}" {{old('family_id',$category->family_id) == $family->id ? 'selected':''}}>
                            {{$family->name}}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="flex justify-end mb-2">
                <button class="btn-red mr-2" type="button" onclick="confirmDelete()">
                    Eliminar
                </button>
                <button type="submit" class="btn-green">
                    Actualizar
                </button>
            </div>
        </form>

        <form id="deleteForm" action="{{route('admin.categories.destroy',$category)}}" method="post" class="hidden">
            @csrf
            @method('DELETE')
        </form>

        <x-validation-errors></x-validation-errors>
    </div>

    @push('warning-alert')
        <script>
            function confirmDelete() {
                Swal.fire({
                    title: "¿Estás seguro?",
                    text: "¡No podrás revertir esto!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "¡Sí, bórralo!",
                    cancelButtonText: "Cancelar"
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById('deleteForm').submit();
                    }
                });
            }

        </script>
    @endpush
</x-admin-layout>
