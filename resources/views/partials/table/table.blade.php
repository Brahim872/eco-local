
<div class="header flex justify-start items-center">
    <div id="search">
        <form>
            <div>
                <input type="text"
                       value=""
                       id="search_datatable"
                       placeholder="Search...."
                       class='bg-gray-50 border  border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-gray-500 focus:border-gray-500 mb-4 block  w-full p-1.5'>
            </div>
        </form>
    </div>
    <div id="filter">
        @include('partials.table.filter')
    </div>
</div>
<div id="spinner-table"></div>
<div id="own_table">

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
                                    <td scope="row"
                                        class="px-6 py-2 font-medium text-gray-900 whitespace-nowrap @if(isset($columns[$id]['class'])) {{$columns[$id]['class']}} @endif ">
                                        <a class="font-medium text-blue-600 hover:underline"
                                           href="{{route($columns[$id]['link'],$rows['hide_slug'])}}">
                                            {{$item}}
                                        </a>
                                    </td>
                                @elseif(isset($columns[$id]['isImage']))

                                    <td scope="row"
                                        class="px-6 py-2 w-max font-medium text-gray-900 whitespace-nowrap @if(isset($columns[$id]['class'])) {{$columns[$id]['class']}} @endif">
                                        <img alt="" class="w-8 h-8 border rounded-full "
                                             src="{{asset($item?'storage/'.$item:'images/default.jpg')}}">
                                    </td>
                                @else
                                    <td scope="row"
                                        class="px-6 py-2 font-medium text-gray-900 whitespace-nowrap @if(isset($columns[$id]['class'])) {{$columns[$id]['class']}} @endif">{{$item}}</td>
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

</div>


