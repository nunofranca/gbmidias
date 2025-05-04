<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Http;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
      Http::macro('upmidias', function(){
        return Http::baseUrl('https://upmidiass.net/api/v2');
      });


      Http::macro('whatsapp', function () {
        return Http::withToken('EAAmCXTP7IXgBOxbaMVGZBYV379Rrl1U1M2QkFHnZBbhuzdldkwAs37IZBUhH4R0atWYGIf57buiBCZAmEtvXTdW1i9ADZBwA24hAKFzSjydlU39IEfsKpnySbD9EMkE3DnUP4KjaK1ct7vcitV5Na7MK9yY9jvkZB0RItP74xAWliGrsOkOZCBdLSi3q9oNPYxTosywGaZCuG9GtwsUlUtr1cdYaaeUZD')
            ->baseUrl('https://graph.facebook.com/v22.0/551757028021017');

      });

      
      Http::macro('gpt', function () {
        return Http::withHeaders([
            'OpenAI-Beta' => 'assistants=v2',
        ])->withToken(config('gpt.token'))
            ->baseUrl('https://api.openai.com/v1');
    });
    }
}
