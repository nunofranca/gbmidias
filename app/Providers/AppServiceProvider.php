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
        return Http::withToken('EAAem1g2arPYBOyqQy041nNhkv34E0440CyOR9ANewYtFIdFcYTCZCAjG7wlLR7vuZCohcuKu1M72graD8rEd198it0ZCbnsNfp02JxXQO9POmx4ZC40nKbG5J9jYOWoQf2oArhJlEcL3e6gPHdPSQo5X4zAsWdfKcRe6ZC8MW0lb2S7e5NGxpCPCezvUjIcNP7ufKAwbDso424ZAlFhvTUHimJy0UZD')
            ->baseUrl('https://graph.facebook.com/v22.0/551757028021017');

      });

      
      Http::macro('gpt', function () {
        return Http::withHeaders([
            'OpenAI-Beta' => 'assistants=v2',
        ])->withToken(config('gpt.token'))
            ->baseUrl('https://api.openai.com/v1');
      });

      Http::macro('pushinpay', function () {
        return Http::withHeaders([
          "Authorization"=> config('pushinpay.token'),
          "Content-Type"=> "application/json"
        ])->baseUrl('https://api.pushinpay.com.br/api');
      });









     Http::macro('openpix', function () {
      return Http::withHeaders([
          'Authorization' => 'Q2xpZW50X0lkXzMzMzljNWRkLTg4ZGMtNDJlZS05ZWU1LTY0NDc4MmFlN2NiNjpDbGllbnRfU2VjcmV0X3JHcGxMWWRBNWJGcVJQZmNzVE1XVG4zK2MzUS85WGRxdTRhRGZnb0FlOTg9',
      ])
          ->baseUrl('https://api.openpix.com.br/api/v1');
  });
    }
}
