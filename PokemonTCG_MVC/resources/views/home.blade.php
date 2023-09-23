<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

        <!-- Styles -->
         <script src="https://cdn.tailwindcss.com"></script>
        <style>

        </style>
    </head>
    <body class="antialiased">
            <div class="flex justify-center items-center w-screen h-screen">
                @foreach ($users as $user)
                    <div class="bg-white shadow-lg rounded-lg px-4 py-6 m-4">
                        <h2 class="text-2xl font-bold">{{ $user['first_name'] }} {{ $user['last_name'] }}</h2>
                        <h3 class="text-xl">{{ $user['location'] }}</h3>
                    </div>
                @endforeach
            </div>
    </body>
</html>
