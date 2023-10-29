@extends('layouts.app')
@section('content')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script>
let debounceTimer;

/**
 * Debounces a function call to prevent it from being called too frequently.
 *
 * @param {Function} func - The function to be debounced.
 * @param {number} delay - The delay in milliseconds before the function is called.
 */
function debounce(func, delay) {
    clearTimeout(debounceTimer);
    debounceTimer = setTimeout(func, delay);
}

/**
 * Searches for a card in the collection based on the set ID and card name.
 *
 * @param {string} setId - The ID of the set to search in.
 * @param {string} cardName - The name of the card to search for.
 */
function searchCardCollection(setId, cardName) {
    document.getElementById('loader').style.display = 'block';
}

/**
 * Handles the input change event and debounces the search function call.
 */
function handleInputChange() {
    debounce(function() {
        searchCardCollection(document.querySelector('.search-dropdown').value, document.getElementById(
            'cardName').value);
    }, 1000);
}


/**
 * This function sends an AJAX request to search for a card in the database based on the set ID and card name.
 * It then dynamically creates HTML elements to display the search results and allows the user to add a card to their collection.
 *
 * @param int $setId The ID of the set to search for the card in.
 * @param string $cardName The name of the card to search for.
 * @return void
 */
function searchCardCollection($setId, $cardName) {
    // Display loader while AJAX request is being made
    document.getElementById('loader').style.display = 'block';

    // Send AJAX request to search for card
    $.ajax({
        type: 'POST',
        url: '/searchcard',
        data: {
            _token: "{{ csrf_token() }}",
            setId: $setId,
            cardName: $cardName
        },
        success: function(response) {
            // Clear previous search results
            var cardContainer = document.getElementById('cardContainer');
            cardContainer.innerHTML = "";

            // Loop through search results and create HTML elements to display each card
            response.forEach(function(card) {
                var cardName = card.name;
                var cardImage = card.images.small;
                var cardRarity = card.rarity;
                var setName = card.set.name;
                var setImage = card.set.images.logo;
                var cardType = card.number;

                var cardElement = document.createElement('div');
                cardElement.classList.add('flex',
                    'flex-col',
                    'items-center',
                    'bg-white',
                    'border',
                    'border-gray-200',
                    'rounded-lg',
                    'shadow',
                    'md:flex-row',
                    'md:max-w-xl',
                    'hover:bg-gray-100',
                    'dark:border-gray-700',
                    'dark:bg-gray-800',
                    'dark:hover:bg-gray-700');


                var cardData = JSON.stringify({
                    name: card.name,
                    type: card.number,
                    rarity: card.rarity,
                    image: card.images.small
                });

                cardElement.innerHTML = `
                        <img class="object-cover w-full rounded-t-lg h-96 md:h-auto md:w-48 md:rounded-none md:rounded-l-lg" src="${cardImage}">
                        <div class="flex flex-col justify-between p-4 leading-normal">
                            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900">${cardName}</h5>
                            <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">${cardRarity}</p>
                            <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">${setName}</p>
                            <img class="w-14 h-14 object-contain" src="${setImage}">
                            <button onclick='addCardToUser(${JSON.stringify(cardData)})' class="p-4 bg-green-500">Add</button>
                        </div>
                    `;

                cardContainer.appendChild(cardElement);
                setTimeout(function() {
                    document.getElementById('loader').style.display = 'none';
                }, 50);
            });
        },
        error: function(xhr, status, error) {
            // Display error message if AJAX request fails
            var err = JSON.parse(xhr.responseText);
            console.log(err.message);
        }
    });
}

/**
 * This function sends an AJAX request to add a card to the user's collection.
 *
 * @param string $cardData The card data to add to the user's collection.
 * @return void
 */
function addCardToUser($cardData) {
    // Parse card data from JSON string
    var card = JSON.parse($cardData);
    console.log($cardData)

    // Send AJAX request to add card to user's collection
    $.ajax({
        type: 'POST',
        url: '/cards/create',
        data: {
            _token: "{{ csrf_token() }}",
            name: card.name,
            type: card.type,
            rarity: card.rarity,
            image: card.image
        },
        success: function(response) {
            // Display success message if AJAX request succeeds
            console.log(response);
            document.getElementById('successMessage').style.display = 'block';

        },
        error: function(xhr, status, error) {
            // Display error message if AJAX request fails
            var err = JSON.parse(xhr.responseText);
            console.log(err.message);
            document.getElementById('errorMessage').style.display = 'block';
        }
    });
}
</script>

<div class="w-full h-full">
    <!-- Filters -->
    <div class="w-screen  items-center justify-center flex  mt-4 gap-y-2">
        <div class="flex flex-col">
            <div>
                <h1 class="text-center text-xl font-bold">Filters</h1>
            </div>
            <div class="flex flex-row">
                <div class="flex flex-col">
                    <h2 class="text-lg">Set</h2>
                    <select class="search-dropdown"
                        onchange="searchCardCollection(this.value, document.getElementById('cardName').value)">
                        <option value="All">All</option>
                        @foreach ($sets as $set)
                        <option value="{{ $set->getId() }}">{{ $set->getName() }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <h2 class="text-lg">Name</h2>
                    <input class="h-[22px]" type="text" id="cardName" placeholder="Search a card"
                        oninput="handleInputChange()">
                </div>
            </div>
        </div>
    </div>

    <!-- Loader -->
    <div id="loader" class="flex justify-center items-center mt-4" style="display: none;">
        <div class="w-16 h-16">
            <div class="flex justify-between">
                <div class="w-4 h-4 bg-gray-900 rounded-full animate-bounce"></div>
                <div class="w-4 h-4 bg-gray-900 rounded-full animate-bounce" style="animation-delay: 0.1s;"></div>
                <div class="w-4 h-4 bg-gray-900 rounded-full animate-bounce" style="animation-delay: 0.2s;"></div>
            </div>
        </div>
    </div>

    <!-- Cards -->
    <div class=" justify-center items-center w-full flex">
        <div id="cardContainer" class=" mt-12 grid grid-cols-3 gap-2 ">
        </div>
    </div>
</div>

<div id="successMessage" class="fixed bottom-4 right-4 bg-green-500 text-white font-bold py-2 px-4 rounded-lg"
    style="display: none;">
    Card has been added.
</div>
<div id="errorMessage" class="fixed bottom-4 right-4 bg-red-500 text-white font-bold py-2 px-4 rounded-lg"
    style="display: none;">
    Error message here.
</div>

<!-- <form method="POST" action="{{ route('cards.store') }}" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label for="name">Naam:</label>
                <input type="text" name="name" id="name" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="type">Type:</label>
                <input type="text" name="type" id="type" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="rarity">Zeldzaamheid:</label>
                <input type="text" name="rarity" id="rarity" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="image">Afbeelding:</label>
                <input type="file" name="image" id="image" class="form-control-file" required>
            </div>


            <div class="form-group">
                <button type="submit" class="btn btn-primary">Toevoegen</button>
            </div>
        </form> -->
</div>
@endsection