@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
    <div class="mt-8 bg-white dark:bg-gray-800 overflow-hidden shadow sm:rounded-lg">
        <div class="p-6 bg-white dark:bg-gray-800">
            <h2 class="text-2xl font-bold mb-8">Make a new collection</h2>
            @if ($errors->any())
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-8" role="alert">
                <p class="font-bold">Er is iets misgegaan</p>
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <form method="post" action="{{ route('collections.store') }}" class="w-full max-w-lg">
                @csrf

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="name">
                        Name:
                    </label>
                    <input
                        class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        id="name" name="name" type="text" placeholder="Naam">
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="active">
                        Active:
                    </label>
                    <input type="checkbox" class="form-checkbox h-5 w-5 text-blue-600" id="active" name="active"
                        value="1">
                </div>

                <input type="hidden" name="cardids" id="cardids" value="">

                <h2>Selected Cards:</h2>
                <ul id="selected-cards-list"></ul>

                <div class="flex items-center justify-between">
                    <button type="submit"
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                        Save
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<h2>Available cards:</h2>
<div class="grid grid-cols-3 gap-4">
    @foreach ($cards as $card)
    <div class="bg-white overflow-hidden shadow rounded-lg">
        <img class="w-full h-64 object-cover" src="{{ $card->image }}" alt="{{ $card->name }}">
        <div class="px-4 py-4">
            <h4 class="text-lg font-bold">{{ $card->name }}</h4>
            <p class="text-gray-600">{{ $card->description }}</p>
            <button onclick="addCard({{ $card->id }}, '{{ $card->name }}')"
                class="mt-4 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Add</button>
        </div>
    </div>
    @endforeach
</div>
@endsection

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
var selectedCards = [];

function addCard(cardId, cardName) {
    selectedCards.push({
        id: cardId,
        name: cardName
    });
    updateSelectedCards();
}

function updateSelectedCards() {
    $("#selected-cards-list").empty();
    var cardIds = selectedCards.map(card => card.id);
    $("#cardids").val(JSON.stringify(cardIds));
    selectedCards.forEach(function(card) {
        $("#selected-cards-list").append("<li>" + card.name + "</li>");
    });
    console.log(selectedCards);
}


$(document).ready(function() {
    $("form").submit(function(e) {
        updateSelectedCards();
    });
});
</script>