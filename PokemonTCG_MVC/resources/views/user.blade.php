@extends('layouts.app')

@section('content')

        <div class="w-screen h-screen flex justify-center items-center">
            <div class="flex-col">

    <h1>Gebruikers</h1>
    <ul>
        <a href="/users">Terug</a>

            <li>
            <strong>Gebruikersnaam:</strong> <a href="/users/{{ $user->id }}">{{ $user->name }}</a><br>

                <strong>E-mail:</strong> {{ $user->email }}<br>
                <strong>Rol:</strong> {{ $user->role }}<br>
            </li>
    </ul>
    </div>


</div>
@endsection

