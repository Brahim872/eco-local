<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>
        <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">
        <!-- Livewire styles -->

        <!-- Scripts -->
        <link rel="icon" href="{{asset('/images/logo.png')}}" />
        <link rel="stylesheet" href="{{asset('/css/app.css')}}" />
        @stack('styles')
    </head>

    <body class="font-sans antialiased">
    <div class="flex flex-wrap bg-gray-100 w-full h-screen">
        @include('layouts.sidebar')

        <div class="w-10/12 ">
            @include('layouts.navigation')

            <div class="p-4 text-gray-500">
                {{ $slot }}
            </div>
        </div>
    </div>


    <script src="https://cdn.tailwindcss.com"></script>
    <script src="{{asset('/js/app.js')}}"></script>
    <script>
        function searchTable() {
            document.querySelector("#searchForm").submit();
        }
    </script>
        @stack('scripts')
        <!-- Livewire scripts -->
    </body>
</html>
