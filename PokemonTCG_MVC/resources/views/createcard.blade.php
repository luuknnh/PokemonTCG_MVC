@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Nieuwe Kaart Toevoegen</h2>

        <form method="POST" action="{{ route('cards.store') }}" enctype="multipart/form-data">
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
        </form>
    </div>
@endsection
