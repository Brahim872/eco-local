@php

    $pages = [
    10,25,50,100,250
]

@endphp


<select  name="number-pagination"
         id="number_pagination"
         class="cursor-pointer w-[70px] block px-2 py-1 mx-3 leading-tight text-gray-500 bg-white border border-gray-300 rounded-lg hover:bg-gray-100 hover:text-gray-700 ">
    @foreach($pages as $id=>$item)
        <option @if($dataTable['to'] == $item) selected @endif value="{{$item}}">{{$item}}</option>
    @endforeach
</select>
