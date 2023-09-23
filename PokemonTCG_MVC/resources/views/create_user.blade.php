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
        <div class="w-screen h-screen flex items-center justify-center">
            <div class="flex-row space-y-4">
    <h1>Gebruiker Toevoegen</h1>
    <form method="POST" action="/users">
        @csrf <!-- Een CSRF-token voor beveiliging -->
        <label for="username">Gebruikersnaam:</label>
        <input type="text" name="username" id="username"><br>

        <label for="emailaddress">E-mailadres:</label>
        <input type="text" name="emailaddress" id="emailaddress"><br>

        <label for="userpassword">Wachtwoord:</label>
        <input type="password" name="userpassword" id="userpassword"><br>

        <label for="role">Rol:</label>
        <select name="role" id="role">
            <option value="admin">Admin</option>
            <option value="user">Gebruiker</option>
        </select><br>
    
        <button type="submit">Opslaan</button>
    </div>
        </div>
    </form>
    </body>
</html>
