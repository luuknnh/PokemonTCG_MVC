@extends('layouts.app')

@section('content')

        <div class="w-screen h-screen flex justify-center items-center">
            <div class="flex-col">

    <h1>Gebruikers</h1>
    <ul>
        @foreach($users as $user)
            <li>
                <strong>Gebruikersnaam:</strong> {{ $user->name }}<br>
                <strong>E-mail:</strong> {{ $user->email }}<br>
                <strong>Rol:</strong> {{ $user->role }}<br>
            </li>
        @endforeach
    </ul>
    </div>
</div>
@endsection

