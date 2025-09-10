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

        <!-- Styles / Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="flex bg-[#F7F6ED]">
        <header class="relative flex items-center justify-center w-screen h-36 bg-[#F0E6C2]">
            <img src="{{ asset('/img/Logo.png') }}" class="bg-cover h-3/4">
            <div class="absolute bottom-0 flex items-center justify-center">
                <div class="bg-green-700 w-1 h-1 rounded-full mr-1"></div><p class="text-[#152B38] text-center font-lalezar">69 users online</p>
            </div>
        </header>
    </body>
</html>
