<div id="parent-table" data-table="{{$prefixName}}">

    <div id="spinner-table"></div>

    <table class="w-full text-sm text-left text-gray-500 " data-table="{{$prefixName}}">
        <thead class="text-xs rounded-lg text-gray-700 uppercase bg-gray-100 ">
        <tr>
            @foreach($columns as $key=>$rows)
                @if(!isset($rows['display']) || $rows['display']==true)
                    <th @if(isset($rows['sortable'])) class="sortable sort_{{$rows['sortable']}} px-6 py-3" scope="col"
                        data-sort="{{$rows['sortable']}}" @endif >{{$rows['title']}} </th>
                @endif
            @endforeach
            @if($withAction)
                <th> Actions</th>
            @endif
        </tr>

        </thead>


        <tbody id="bs__table">
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
                                <td scope="row"
                                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap ">{{$item}}</td>
                            @endif
                        @endif
                    @endif
                @endforeach
                @if($withAction)
                    <td> @include('backend.'.$prefixName.'.actions')</td>
                @endif
            </tr>
        @endforeach


        </tbody>
    </table>

    <div class="mt-4  w-max flex items-center">
        <div id="column-number">@include('partials.table.column-number')</div>
        <div id="pagination">@include('partials.table.pagination')</div>
        <div id="pagination-info">@include('partials.table.pagination-info')</div>
    </div>

</div>
