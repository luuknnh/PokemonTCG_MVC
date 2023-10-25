@extends('layouts.app')

@section('content')

        <div class="w-screen h-screen flex justify-center items-center">
            <div class="flex-col">

    <h1>Gebruikers</h1>
    <ul>
        @foreach($users as $user)
            <li>
            <strong>Gebruikersnaam:</strong> <a href="/users/{{ $user->id }}">{{ $user->name }}</a><br>
                <strong>E-mail:</strong> {{ $user->email }}<br>
                <strong>Rol:</strong> {{ $user->role }}<br>
                @if (Auth::user()->role == 'admin')
                <a class ="bg-red-500 p-2 mt-4" href="/users/delete/{{ $user->id }}" onclick="return confirm('Weet je zeker dat je deze gebruiker wilt verwijderen?')">Verwijder</a><br>
                @endif
            </li>
        @endforeach
    </ul>
    </div>
    @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

</div>
@endsection

