

@foreach($listFilter as $key=>$filters)
{{--    {{dd($filters)}}--}}
        <select id="{{$key}}"
                name="{{$filters[0]}}"
                class="filter_table_data bg-gray-50 mb-4 mx-2 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-1.5 ">
            <option value="" selected>{{__('app.'.$key)}}</option>
            @foreach($filters[1] as $id=>$item)

                <option value="{{$id}}">{{$item}}</option>
            @endforeach
        </select>

@endforeach

