<div>
    <div class="relative overflow-x-auto mb-4 card">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
            <tr>
                @foreach($columnsTable as $col)
                    <th scope="col" class="px-6 py-3">
                        {{$col}}
                    </th>
                @endforeach
            </tr>
            </thead>
            <tbody>
            @foreach($rows as $row)
                <tr class="bg-white border-b border-gray-200">
                    @foreach($fields as $field)
                        <td class="px-6 py-4">
                            {{ data_get($row, $field) }}
                        </td>
                    @endforeach
                    @if($routeEdit)
                        <td class="px-6 py-4">
                            <a
                                href="{{ route($routeEdit, $row->id) }}"
                                class="text-blue-500 hover:underline"
                            >
                                Editar
                            </a>
                    @endif
                </tr>
            @endforeach
            </tbody>
        </table>


    </div>
    {{-- Paginación, si aplica --}}
    @if(method_exists($rows, 'links'))
        <div class="mt-4">
            {{ $rows->links() }}
        </div>
    @endif

</div>

