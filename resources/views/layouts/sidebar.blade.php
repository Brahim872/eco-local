<!-- component -->
{{----}}
<div class="w-2/12 bg-white rounded p-3 shadow-lg">
    <div class="flex items-center space-x-4 p-2 mb-5">
        <img class="h-12 rounded-full" src="http://www.gravatar.com/avatar/2acfb745ecf9d4dccb3364752d17f65f?s=260&d=mp"
             alt="James Bhatta">
        <div>
            <h4 class="font-semibold text-lg text-gray-700 capitalize font-poppins tracking-wide">James Bhatta</h4>
            <span class="text-sm tracking-wide flex items-center space-x-1">
                    <svg class="h-4 text-green-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                         stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                    </svg><span class="text-gray-600">Verified</span>
                </span>
        </div>
    </div>

    <ul class="space-y-2 text-sm">


        <x-admin.aside.asidbare title="Dashboard" route="{{ route('dashboard') }}">
            <svg class="h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
            </svg>
        </x-admin.aside.asidbare>

        @can('company.read')
            <x-admin.aside.asidbare title="company" route="{{ route('company.index') }}">
                <svg class="h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                     stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                </svg>
            </x-admin.aside.asidbare>
        @endcan
        {{--        <x-admin.aside.asidbare title="client" route="{{ route('client.index') }}">--}}
        {{--            <svg class="h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">--}}
        {{--                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"--}}
        {{--                      d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>--}}
        {{--            </svg>--}}
        {{--        </x-admin.aside.asidbare>--}}

        {{--        <x-admin.aside.asidbare title="products" route="{{ route('product.index') }}">--}}
        {{--            <svg class="h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">--}}
        {{--                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"--}}
        {{--                      d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>--}}
        {{--            </svg>--}}
        {{--        </x-admin.aside.asidbare>--}}

        {{--        <x-admin.aside.asidbare title="contacts" route="{{ route('contact.index') }}">--}}
        {{--            <svg class="h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">--}}
        {{--                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"--}}
        {{--                      d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>--}}
        {{--            </svg>--}}
        {{--        </x-admin.aside.asidbare>--}}

        {{--        <x-admin.aside.asidbare title="campaigns" route="{{ route('campaign.index') }}">--}}
        {{--            <svg class="h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">--}}
        {{--                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"--}}
        {{--                      d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>--}}
        {{--            </svg>--}}
        {{--        </x-admin.aside.asidbare>--}}


        @php
            $active_menu_third = ['user', 'user/*','permission','permission/*','role','role/*',];
        @endphp

        <x-admin.aside.subasidbare route="#" title="Parameter"
                                   active="{{ (new App\Helpers\Tools)->openMenu($active_menu_third) }}">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path opacity="0.3" d="M18 10V20C18 20.6 18.4 21 19 21C19.6 21 20 20.6 20 20V10H18Z"
                      fill="currentColor"/>
                <path opacity="0.3" d="M11 10V17H6V10H4V20C4 20.6 4.4 21 5 21H12C12.6 21 13 20.6 13 20V10H11Z"
                      fill="currentColor"/>
                <path opacity="0.3" d="M10 10C10 11.1 9.1 12 8 12C6.9 12 6 11.1 6 10H10Z" fill="currentColor"/>
                <path opacity="0.3" d="M18 10C18 11.1 17.1 12 16 12C14.9 12 14 11.1 14 10H18Z" fill="currentColor"/>
                <path opacity="0.3" d="M14 4H10V10H14V4Z" fill="currentColor"/>
                <path opacity="0.3" d="M17 4H20L22 10H18L17 4Z" fill="currentColor"/>
                <path opacity="0.3" d="M7 4H4L2 10H6L7 4Z" fill="currentColor"/>
                <path
                    d="M6 10C6 11.1 5.1 12 4 12C2.9 12 2 11.1 2 10H6ZM10 10C10 11.1 10.9 12 12 12C13.1 12 14 11.1 14 10H10ZM18 10C18 11.1 18.9 12 20 12C21.1 12 22 11.1 22 10H18ZM19 2H5C4.4 2 4 2.4 4 3V4H20V3C20 2.4 19.6 2 19 2ZM12 17C12 16.4 11.6 16 11 16H6C5.4 16 5 16.4 5 17C5 17.6 5.4 18 6 18H11C11.6 18 12 17.6 12 17Z"
                    fill="currentColor"/>
            </svg>


            <x-slot name="submenu">
                <x-admin.aside.asidbare title="Users" route="{{ route('user.index') }}">
                    <svg class="h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                         stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                </x-admin.aside.asidbare>

                <x-admin.aside.asidbare title="Permissions" route="{{ route('permission.index') }}">
                    <svg class="h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                         stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                </x-admin.aside.asidbare>

                <x-admin.aside.asidbare title="Roles" route="{{ route('role.index') }}">
                    <svg class="h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                         stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                </x-admin.aside.asidbare>
            </x-slot>
        </x-admin.aside.subasidbare>


        <li>
            <!-- Authentication -->
            <form method="POST" action="{{ route('logout') }}">
                @csrf

                <a href="{{route('logout')}}"
                   onclick="event.preventDefault();
                       this.closest('form').submit();"
                   class="flex items-center space-x-3 text-gray-700 p-2 rounded-md font-medium hover:bg-gray-200 focus:bg-gray-200 focus:shadow-outline">
                        <span class="text-gray-600">
                            <svg class="h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                 stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                            </svg>
                        </span>
                    <span>Logout</span>
                </a>

            </form>

        </li>
    </ul>
</div>


