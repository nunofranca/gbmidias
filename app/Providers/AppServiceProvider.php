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
        return Http::withToken('EAAem1g2arPYBO6ZBdZBZADdBaIiaPGSPAiZCPAjgQflJy0ENV8oXUoZC0J81ZBupQz5rAywm8nnNvgH0YaZCP3T9rnvoKgBYHKKzDdAL6JOxQDyZBQwPUSZCw5TvchyUxZAN60VfvIDtFPJoNhc7bSJxZATJf5wj98FJFcFByO8AA5d1ofkDXP0B1CEPJtc1ZCTDScHGaJQZACReFfRM7yW2XkUrNIQG4RkcZD')
            ->baseUrl('https://graph.facebook.com/v22.0/649078624950335');

      });

      
      Http::macro('gpt', function () {
        return Http::withHeaders([
            'OpenAI-Beta' => 'assistants=v2',
        ])->withToken(config('gpt.token'))
            ->baseUrl('https://api.openai.com/v1');
      });

      Http::macro('pushinpay', function () {
        return Http::withToken('27316|f8uPlc4pcD6waXfulsJm9wZ3GzIM1ScMZsTFcpOp14f3ccee')
        ->withHeaders([
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
