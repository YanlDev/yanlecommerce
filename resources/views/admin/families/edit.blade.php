<x-admin-layout :breadcrumbs="[
    [
        'name' => 'Dashboard',
        'route' => route('admin.dashboard')
    ],
    [
        'name' => 'Familias',
        'route'=> route('admin.families.index')
    ],
    [
        'name'=>'Editar'
    ]
]"
    {{--BOTON DE ACCION POR SI SE VA CREAR ALGO NUEVO EN ESA RUTA--}}
    {{--:actionLink="route('admin.families.create')"--}}
>
    <div class="card">
        <form action="{{route('admin.families.update', $family)}}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-2">
                <x-label class="mb-2">
                    Editar Familia
                </x-label>
                <x-input class="w-full" placeholder="Ingrese el nombre de la familia a crear"
                         value="{{old('name',$family->name)}}" name="name">
                </x-input>
            </div>
            {{--Vamos a implementar el delete mandando otro formulario con la ayuda de JS--}}
            <div class="flex justify-end mb-2">
                <button class="btn-red mr-2" type="button" onclick="confirmDelete()">
                    Eliminar
                </button>
                <button type="submit" class="btn-green">
                    Actualizar
                </button>
            </div>
        </form>

        <form id="deleteForm" action="{{route('admin.families.destroy',$family)}}" method="post" class="hidden">
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
