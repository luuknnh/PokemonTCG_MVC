@extends('layouts.app')

@section('content') 
<div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow sm:rounded-lg">
        <div class="p-6 bg-white dark:bg-gray-800">
            <h2 class="text-2xl font-bold mb-8">{{ $collection->name }}</h2>
            <p class="text-gray-600 mb-4">Aantal kaarten: {{ $collection->quantity }}</p>

            <div class="flex flex-wrap">
                @foreach ($collection->cards as $card)
                    <div class="w-1/4 p-4">
                        <div class="bg-white overflow-hidden shadow rounded-lg">
                            <img class="w-full h-64 object-cover" src="{{ $card->image }}" alt="{{ $card->name }}">
                            <div class="px-4 py-4">
                                <h4 class="text-lg font-bold">{{ $card->name }}</h4>
                                <p class="text-gray-600">{{ $card->description }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
