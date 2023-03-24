@if(isset($listFilter))
<form action="" id="form_filter_dataTable">
    @foreach($listFilter as $key=>$filters)

        <select id="{{$key}}"
                name="{{$filters[0]}}"
                class="filter_table_data bg-gray-50 mb-4 mx-2 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-1.5 ">
            <option value="" selected>{{__('app.'.$filters[0])}}</option>
            @foreach($filters[1] as $id=>$item)

                <option value="{{$id}}">{{$item}}</option>
            @endforeach
        </select>

    @endforeach
</form>
@endif
