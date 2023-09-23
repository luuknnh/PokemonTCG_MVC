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
    <h1>Gebruikerslijst</h1>
    <ul>
        @foreach($users as $user)
            <li>
                <strong>Gebruikersnaam:</strong> {{ $user->username }}<br>
                <strong>E-mail:</strong> {{ $user->email }}<br>
            </li>
        @endforeach
    </ul>
    </body>
</html>
