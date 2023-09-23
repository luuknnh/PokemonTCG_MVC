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
        <div class="w-screen h-screen flex justify-center items-center">
            <div class="flex-col">
    <h1>Gebruikers</h1>
    <ul>
        @foreach($users as $user)
            <li>
                <strong>Gebruikersnaam:</strong> {{ $user->username }}<br>
                <strong>E-mail:</strong> {{ $user->emailaddress }}<br>
                <strong>Rol:</strong> {{ $user->role }}<br>
            </li>
        @endforeach
    </ul>
    <a href="/users/create">Gebruiker Toevoegen</a>
    </div>
</div>
    </body>
</html>
