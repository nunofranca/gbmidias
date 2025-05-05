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
        return Http::withToken('EAAmCXTP7IXgBOZCFbKWbcENtub7DwV3nukFVKQ2CAYsE6b2ZBTTZBP0hDsprRaXwqXJo3SJNC5zNG6wVZC5vGyhCQE15Tqpz4VcQfnVu9bPpY1WGhTocTtG2xpXTibqAMfFZC6hkZCHZCIqWRQQbBqZBbX1zoGuIYzS0pdWOajJtui1wGZCnC3zyBdVZBsAGsHfv0tZBJ8ZAbH0zfxwlJfeMwP0w9uYiYmkZD')
            ->baseUrl('https://graph.facebook.com/v22.0/551757028021017');

      });

      
      Http::macro('gpt', function () {
        return Http::withHeaders([
            'OpenAI-Beta' => 'assistants=v2',
        ])->withToken(config('gpt.token'))
            ->baseUrl('https://api.openai.com/v1');
     });









     Http::macro('openpix', function () {
      return Http::withHeaders([
          'Authorization' => 'Q2xpZW50X0lkXzMzMzljNWRkLTg4ZGMtNDJlZS05ZWU1LTY0NDc4MmFlN2NiNjpDbGllbnRfU2VjcmV0X3JHcGxMWWRBNWJGcVJQZmNzVE1XVG4zK2MzUS85WGRxdTRhRGZnb0FlOTg9',
      ])
          ->baseUrl('https://api.openpix.com.br/api/v1');
  });
    }
}
