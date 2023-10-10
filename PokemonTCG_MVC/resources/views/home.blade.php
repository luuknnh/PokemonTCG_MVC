@extends('layouts.app')

@section('content')
<div class="w-screen h-full mt-4">
    <div class="flex flex-col justify-center items-center gap-4">
        <div class="w-fit">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div>

                <div class="w-fit">
            <div class="card">
                <div class="card-header">Cards</div>

                <div class="card-body">

                    <a href="/cards">{{$cardsAmount}}</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
