@if(count($breadcrumbs))
    <nav>
        <ol class="flex flex-wrap">
            @foreach($breadcrumbs as $item)
                {{-- LA VARIABLE LOOP SE CREA CUANDO USAMOS BUCLES AHORA, !$loop->firts PREGUNTA SI ESTAMOS EN LA PRIMER ITERACION Y !NIEGA LA PRIMERA ITERACION                --}}
                <li class="leading-normal text-sm text-slate-700 {{  !$loop->first ? "pl-2 before:float-left before:pr-2 before:content-['>']" : '' }}">

                    {{--                    ISSET PREGUNTA SI SE ENCUENTA DEFINIDO EN EL BREADCUMBS UN CAMPO ROUTE--}}
                    @isset($item['route'])
                        <a href="{{$item['route']}}" class="opacity-50">
                            {{$item['name']}}
                        </a>
                @else
                    {{$item['name']}}
                @endisset

            @endforeach
        </ol>

        <div class="flex justify-between items-center mb-4">
            <h6 class="font-semibold">
                {{end($breadcrumbs)['name']}}
            </h6>
            @if($actionLink)
                <a href="{{$actionLink}}" class="btn-blue">Crear</a>
            @endif
        </div>

    </nav>
@endif
