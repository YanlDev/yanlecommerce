<x-admin-layout :breadcrumbs="[
    [
        'name' => 'Dashboard',
        'route' => route('admin.dashboard')
    ],
    [
        'name' => 'Productos',
        'route' => route('admin.products.index')
    ],
    [
        'name' => $product->name,
        'route' => route('admin.products.edit', $product)
    ],
    [
        'name' => $variant->features->pluck('description')->implode(' , ')
    ]
]"
    {{--BOTON DE ACCION POR SI SE VA CREAR ALGO NUEVO EN ESA RUTA--}}
    {{--                :actionLink="route('admin.products.create')"--}}
>

    <form action="{{route('admin.products.variantsUpdate', [$product, $variant])}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-6 relative">
            <figure>
                <img src="{{$variant->image}}" alt="Imagen de producto variante"
                     class="aspect-[16/9] object-cover object-center w-full" id="imgPreview">
            </figure>
            <div class="absolute top-8 right-8">
                <label class="flex items-center bg-white px-4 py-2 rounded-lg cursor-pointer">
                    <i class="fas fa-camera mr-2"></i>
                    Actualiza imagen
                    <input type="file" name="image" accept="image/*" class="hidden"
                           onchange="previewImage(event, '#imgPreview')">
                </label>
            </div>
        </div>
        <div class="card">
            <div class="mb-4">
                <x-label class="mb-1">
                    Código SKU
                </x-label>
                <x-input
                    class="w-full"
                    name="sku"
                    value="{{old('sku', $variant->sku)}}"
                    placeholder="Ingrese el código SKU"
                >
                </x-input>
            </div>
            <div class="mb-4">
                <x-label class="mb-1">
                    Stock
                </x-label>
                <x-input
                    class="w-full"
                    name="stock"
                    value="{{old('stock', $variant->stock)}}"
                    placeholder="Ingrese el Stock"
                >
                </x-input>
            </div>
            <div class="flex justify-end">
                <button class="btn-green">Actualizar</button>
            </div>
        </div>
        <x-validation-errors/>
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
