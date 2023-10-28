@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
    <h2 class="text-2xl font-bold my-4">My Collections</h2>
    <div class="flex justify-end mb-4">
        <a href="/collections/create" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Add A
            Collection</a>
    </div>
    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
        @foreach ($collections as $collection)
        <div class="bg-white overflow-hidden shadow rounded-lg">
            <a href="/collections/{{ $collection->id }}">
                <img class="w-full h-64 object-contain object-center" src="{{ $collection->cards[0]->image }}"
                    alt="{{ $collection->name }}">
            </a>
            <div class="p-4">
                <form action="{{ route('collections.updateStatus', ['id' => $collection->id]) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                        <input type="text" name="name" id="name" value="{{ $collection->name }}"
                            class="mt-1 p-2 border border-gray-300 rounded-md">
                    </div>
                    <label for="active" class="flex items-center">
                        <input id="active" name="active" type="checkbox" class="form-checkbox"
                            {{ $collection->active ? 'checked' : '' }}>
                        <span class="ml-2">Active</span>
                    </label>
                    <button type="submit"
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mt-4">Update
                        status</button>
                </form>
            </div>
        </div>
        @endforeach
    </div>
    @if(session('success'))
    <div x-data="{ show: true }" x-show="show" class="fixed right-4 bottom-4">
        <div x-show="show"
            class="w-64 bg-white border-l-4 border-green-500 shadow rounded-lg p-4 flex justify-between items-center">
            <p class="text-sm text-gray-800">{{ session('success') }}</p>
            <button @click="show = false" class="text-gray-600 hover:text-gray-800">&times;</button>
        </div>
    </div>
    @endif

    @if(session('error'))
    <div x-data="{ show: true }" x-show="show" class="fixed right-4 bottom-4">
        <div x-show="show"
            class="w-64 bg-white border-l-4 border-red-500 shadow rounded-lg p-4 flex justify-between items-center">
            <p class="text-sm text-gray-800">{{ session('error') }}</p>
            <button @click="show = false" class="text-gray-600 hover:text-gray-800">&times;</button>
        </div>
    </div>
    @endif

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        var buttons = document.querySelectorAll('[x-data="{ show: true }"] button');
        buttons.forEach(function(button) {
            button.addEventListener('click', function() {
                this.parentNode.parentNode.style.display = 'none';
            });
        });
    });
    </script>

</div>
@endsection