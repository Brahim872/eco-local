<x-admin.wrapper id="tabs">
    <x-slot name="title">
        <div>
            <ul id="tabs" class="inline-flex w-full px-1 pt-2 ">
                <li class="px-4 py-2 -mb-px font-semibold text-gray-800 border-b-2 border-blue-400 rounded-t opacity-50">
                    <a id="default-tab" href="#first">Profile</a>
                </li>

                <li class="px-4 py-2 font-semibold text-gray-800 rounded-t opacity-50">
                    <a href="#second">Products</a>
                </li>
            </ul>
        </div>
    </x-slot>

    <div id="tab-contents">

        <div class="w-full py-2 bg-white overflow-hidden" id="first">

            @include('backend.company.includes.products')

        </div>

        <div class="w-full py-2 mt-4  bg-white overflow-hidden hidden" id="second">

        </div>

    </div>


</x-admin.wrapper>
