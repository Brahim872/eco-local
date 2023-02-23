

<div id="search"></div>


<table class="w-full text-sm text-left text-gray-500 ">
    <thead class="text-xs rounded-lg text-gray-700 uppercase bg-gray-100 ">
    <tr>
        @foreach($columns as $key=>$rows)
            <th @if(isset($rows['sortable'])) class="sortable px-6 py-3" scope="col"
                data-sort="{{$rows['sortable']}}" @endif >{{$rows['title']}} </th>
        @endforeach
    </tr>

    </thead>

    <tbody id="bs__table"></tbody>
</table>

<div class="mt-4  w-max flex items-center">
    <div id="pagination"></div>
    <div id="pagination-info"></div>
</div>
