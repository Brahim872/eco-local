

        @foreach($dataTable['data'] as $key=>$rows)
            <tr class="bg-white border-b  ">
                @foreach($rows as $id=>$item)
                    <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap ">{{$item}}</td>
                @endforeach
            </tr>
        @endforeach



