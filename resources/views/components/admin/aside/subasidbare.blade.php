<li>

    <p class="dropdown-menubar flex items-center space-x-3 text-gray-700 p-2 rounded-md font-medium hover:bg-green-200  focus:shadow-outline ">

                    <span class="text-gray-600 flex w-3/4">
                        {{$slot??''}}
                        <span class="ml-2">
                        {{$title??''}}
                        </span>
                    </span>

        <span class="text-sm rotate-180 arrow">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512" width="10"><!--! Font Awesome Pro 6.3.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path
                  d="M182.6 137.4c-12.5-12.5-32.8-12.5-45.3 0l-128 128c-9.2 9.2-11.9 22.9-6.9 34.9s16.6 19.8 29.6 19.8H288c12.9 0 24.6-7.8 29.6-19.8s2.2-25.7-6.9-34.9l-128-128z"/></svg>
        </span>
    </p>

    <ul class="submenu-menubar text-left text-sm mt-2 w-4/5 mx-auto text-gray-200 font-bold {{$active??''}}">
        {{$submenu??''}}
    </ul>

</li>
