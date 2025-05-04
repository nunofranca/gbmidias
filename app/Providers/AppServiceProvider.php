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
        return Http::withToken('EAAmCXTP7IXgBOytWaaiWGogVc5MPodK6jPAOwIZAjBVZBTLQEWQRsGy81BxoPYdZBvbaybdsQqktSB7mePZAw992IMIOAY8dlkLhzJvau5l4JGOhpYj1X6BrHl7kjdvPeZBZAFFh2GpQsIZAms6J16qVSDwuwfgDcgpXUgdbZCS96mtFOgeLZAaD8m1kX2zAgwZBN7NpPKZCpfm8YH4tBZAS58tfZCw1Xao8ZD')
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
