@extends('layouts.app')

@section('content')
<div class="w-screen h-screen flex justify-center items-center">

@foreach ($cards as $card)
    <div>
        <img src="data:image/png;base64,{{ $card->image }}">
    </div>
@endforeach


    <a href="{{ route('cards.create') }}" class="bg-green-500 text-white px-4 py-2 rounded">Toevoegen</a>
</div>
@endsection