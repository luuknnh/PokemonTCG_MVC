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
                <a href="/cards">
                    <div class="card-header">My Cards</div>

                    <div class="card-body">

                        @if ($cardsAmount == 0)
                        <img class="rounded-t-lg w-" src="" />
                        @else
                        <img class="rounded-t-lg w-" src="{{ $latestCardImage }}" />
                        @endif
                        <a>{{$cardsAmount}}</a>



                    </div>
                </a>
            </div>
        </div>

        
        <div class="w-fit">
            <div class="card">
                <a href="/collections">
                    <div class="card-header">Collections</div>
<!-- 
                    <div class="card-body">

                        @if ($cardsAmount == 0)
                        <img class="rounded-t-lg w-" src="" />
                        @else
                        <img class="rounded-t-lg w-" src="{{ $latestCardImage }}" />
                        @endif
                        <a>{{$cardsAmount}}</a>



                    </div> -->
                </a>
            </div>
        </div>
    </div>
</div>
@endsection