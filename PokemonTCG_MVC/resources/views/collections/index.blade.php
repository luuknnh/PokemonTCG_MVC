@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
    <h2 class="text-2xl font-bold my-4">Collections</h2>
    <div class="flex justify-end mb-4">
        <a href="/collections/create" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Nieuwe Collectie Toevoegen</a>
    </div>
    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
        @foreach ($collections as $collection)
            <div class="bg-white overflow-hidden shadow rounded-lg">
                <a href="/collections/{{ $collection->id }}">
                    <img class="w-full h-64 object-contain object-center" src="{{ $collection->cards[0]->image }}" alt="{{ $collection->name }}">
                </a>
                <div class="p-4">
                    <a href="/collections/{{ $collection->id }}" class="block mt-1 text-lg leading-tight font-medium text-black hover:underline">{{ $collection->name }}</a>
                    <p class="mt-2 text-gray-500">Aantal kaarten: {{ $collection->quantity }}</p>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
