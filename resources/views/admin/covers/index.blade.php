<x-admin-layout :breadcrumbs="[
    [
        'name' => 'Dashboard',
        'route' => route('admin.dashboard')
    ],
    [
        'name' => 'Portadas',
    ]
]"
                {{--BOTON DE ACCION POR SI SE VA CREAR ALGO NUEVO EN ESA RUTA--}}
                :actionLink="route('admin.covers.create')"
>
    <ul class="space-y-4" id="covers" >
        @foreach($covers as $cover)
            <li class="bg-white rounded-lg shadow-lg lg:flex overflow-hidden cursor-move" data-id="{{$cover->id}}">
                <img src="{{$cover->image}}" alt="portada"
                     class="w-full lg:w-64 aspect-[3/1] object-cover object-center">
                <div class="p-4 lg:flex-1 lg:flex lg:justify-between lg:items-center space-y-2 lg:space-y-0">
                    <div>
                        <h1 class="font-semibold">{{$cover->title}}</h1>
                        <p>
                            @if($cover->is_active)
                                <span
                                    class="bg-green-100 text-green-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-sm">Activo</span>
                            @else
                                <span class="bg-red-100 text-red-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-sm">Inactivo</span>
                            @endif
                        </p>
                    </div>
                    <div>
                        <p class="text-sm font-semibold">Fecha de inicio</p>
                        <p>{{$cover->start_at->format('d/m/y')}}</p>
                    </div>
                    <div>
                        <p class="text-sm font-semibold">Fecha de finalización</p>
                        <p>{{$cover->end_at ? $cover->end_at->format('d/m/y'): '-'}}</p>
                    </div>
                    <div>
                        <a href="{{route('admin.covers.edit', $cover)}}" class="btn-blue ml-0">
                            Editar
                        </a>
                    </div>
                </div>
            </li>
        @endforeach
    </ul>

    @push('js')
        <script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.6/Sortable.min.js"></script>
        <script>
            new Sortable(covers, {
                animation: 150,
                ghostClass: 'bg-blue-100',
                store:{
                    set:(sortable)=>{
                        const sorts  = sortable.toArray();
                        axios.post("{{route('api.sort.covers')}}",{
                            sorts: sorts
                        }).catch((error)=> {
                            console.log(error);
                        })
                    }
                }
            });
        </script>
    @endpush
</x-admin-layout>
