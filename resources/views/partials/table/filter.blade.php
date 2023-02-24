@foreach($listFilter as $key=>$filters)

    <select id="{{$key}}"
            name="{{$key}}"
            class="filter_table_data bg-gray-50 mb-4 mx-2 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">
        <option value="" selected>{{__('app.'.$key)}}</option>
        @foreach($filters as $id=>$item)

            <option value="{{$item['name']}}">{{$item['name']}}</option>
        @endforeach
    </select>


@endforeach

