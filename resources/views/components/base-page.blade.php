<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Lalezar&display=swap" rel="stylesheet">

        <!-- Icons -->
         <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,1,0" />

        <!-- Styles / Scripts -->
        @vite(['resources/css/app.css', 'resources/css/manualStyling.css', 'resources/js/app.js'])
        @livewireStyles
    </head>
    <body class=" min-h-svh bg-[#F7F6ED]">
        <header class="absolute top-0 left-0 flex items-center justify-center w-screen h-36 bg-[#F0E6C2]">
            <a href="{{ route('welcome') }}" class=" h-3/4">
                <img src="{{ asset('/img/Logo.png') }}" class="bg-cover h-full">
            </a>    
            <div class="absolute bottom-0 flex items-center justify-center">
                <div class="bg-green-700 w-1 h-1 rounded-full mr-1"></div><p class="text-[#152B38] text-center font-lalezar">69 users online</p>
            </div>
            <div class="absolute flex right-2 px-5 items-center justify-center bg-[#F7F6ED] p-2 rounded-full">
                @if (!Auth::check())
                <a href="{{ route('user.login'); }}" class="mr-3">
                    <span class="material-symbols-outlined">
                        login
                    </span>
                </a>
                <a href="{{ route('user.register'); }}">
                    <span class="material-symbols-outlined">
                        person_add
                    </span>
                </a>
                @else
                <a href="{{ route('user.logout'); }}" class="mr-3">
                    <span class="material-symbols-outlined">
                        logout
                    </span>
                </a>
                <a href="">
                    <span class="material-symbols-outlined">
                        person
                    </span>
                </a>
                @endif
            </div>
        </header>
        <main class="flex h-screen pt-36 justify-center items-center">
            {{ $slot }}
        </main>
        
        @livewireScripts
    </body>
</html>
