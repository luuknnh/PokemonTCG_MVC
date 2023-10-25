<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Pokemon\Pokemon;


class PokemonTCGServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
public function register()
{
    $this->app->singleton('pokemon-tcg', function () {
        return new Pokemon([
            'api_key' => config('services.pokemontcg.api_key'),
            'base_url' => config('services.pokemontcg.base_url'),
        ]);
    });
}

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
