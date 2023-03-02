@foreach($dataTable['data'] as $key=>$rows)
    <tr class="bg-white border-b  ">
        @foreach($rows as $id=>$item)
            @if(!isset($columns[$id]['display']) || $columns[$id]['display']==true)

                @if(explode('_',$id)[0] != 'hide')

                    @if(isset($columns[$id]['link']) && isset($columns[$id]['parameterLink']))
                        <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap ">
                            <a class="font-medium text-blue-600 hover:underline"
                               href="{{route($columns[$id]['link'],$rows['hide_slug'])}}">
                                {{$item}}
                            </a>
                        </td>
                    @else
                        <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap ">{{$item}}</td>
                    @endif
                @endif
            @endif
        @endforeach
    </tr>
@endforeach



