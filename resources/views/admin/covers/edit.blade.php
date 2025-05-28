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
        'name' => 'Editar'
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

    <form action="{{route('admin.covers.update', $cover)}}"
          method="post"
          enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <x-validation-errors/>
        <figure class="relative mb-4">
            <div class="absolute top-2 right-2">
                <label class="flex items-center px-4 py-2 rounded-lg bg-white hover:bg-gray-100 cursor-pointer">
                    <i class="fas fa-camera mr-2"></i>
                    Actualizar Imagen
                    <input type="file"
                           class="hidden"
                           accept="image/*"
                           name="image"
                           onchange="previewImage(event, '#imgPreview')"
                    >
                </label>
            </div>
            <img src="{{$cover->image}}" alt="imagen de la portada"
                 class="w-full aspect-[3/1] object-cover object-center" id="imgPreview">
        </figure>
        <div class="mb-4">
            <x-label>
                Titulo
            </x-label>
            <x-input placeholder="Por favor ingrese el titulo de la portada" class="w-full" name="title"
                     value="{{old('title', $cover->title)}}"/>
        </div>
        <div class="mb-4">
            <x-label>
                Fecha de inicio
            </x-label>
            <x-input type="date" name="start_at" class="w-full"
                     value="{{old('start_at', $cover->start_at->format('Y-m-d'))}}"/>
        </div>
        <div class="mb-4">
            <x-label>
                Fecha de fin (opcional)
            </x-label>
            <x-input type="date" name="end_at" class="w-full"
                     value="{{old('end_at', $cover->end_at? $cover->end_at->format('Y-m-d'):'')}}"/>
        </div>
        <div class="mb-4 flex space-x-4">
            <label class="flex items-center gap-2">
                <x-input
                    type="radio"
                    name="is_active"
                    value="1"
                    :checked="$cover->is_active == 1"
                />
                Activo
            </label>
            <label class="flex items-center gap-2">
                <x-input
                    type="radio"
                    name="is_active"
                    value="0"
                    :checked="$cover->is_active == 0"
                />
                Inactivo
            </label>
        </div>

        <div class="flex justify-end">
            <button class="btn-green">
                Actualizar portada
            </button>
        </div>
    </form>

    @push('js')
        <script>
            function previewImage(event, querySelector) {

                //Recuperamos el input que desencadeno la acción
                let input = event.target;

                //Recuperamos la etiqueta img donde cargaremos la imagen
                let imgPreview = document.querySelector(querySelector);

                // Verificamos si existe una imagen seleccionada
                if (!input.files.length) return

                //Recuperamos el archivo subido
                let file = input.files[0];

                //Creamos la url
                let objectURL = URL.createObjectURL(file);

                //Modificamos el atributo src de la etiqueta img
                imgPreview.src = objectURL;

            }
        </script>
    @endpush

</x-admin-layout>
