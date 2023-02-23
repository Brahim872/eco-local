<ul class=" flex items-center -space-x-px">

    @foreach ($pagination['links'] as $key=>$link)
        @if($key==0)
            <li class="@if($pagination['prev_page_url'])page_item @endif  cursor-pointer block px-2 py-1 ml-0 leading-tight text-gray-500 bg-white border border-gray-300 rounded-l-lg hover:bg-gray-100 hover:text-gray-700"
                @if($pagination['prev_page_url'])   data-href="{{ $pagination['prev_page_url'] }}"@endif>
                <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                     xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                          d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                          clip-rule="evenodd"></path>
                </svg>
            </li>
        @elseif($key == count($pagination['links'])-1)
            <li class=" @if($pagination['next_page_url'])page_item @endif cursor-pointer block px-2 py-1 leading-tight text-gray-500 bg-white border border-gray-300 rounded-r-lg hover:bg-gray-100 hover:text-gray-700"
                @if($pagination['next_page_url']) data-href="{{ $pagination['next_page_url'] }}" @endif>
                <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                     xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                          d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                          clip-rule="evenodd"></path>
                </svg>
            </li>
        @elseif($pagination['current_page'] == $key)
            <li class="page_item cursor-pointer px-2 py-1 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700"
                data-href="{{ $link['url'] }}">
                {!! $link['label'] !!}
            </li>
        @endif
    @endforeach

</ul>
