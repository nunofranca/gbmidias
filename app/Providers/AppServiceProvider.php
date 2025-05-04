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
        return Http::withToken('EAAmCXTP7IXgBOZCsAGmcxTdyIQwiu2PhfYeAVolFygwD4CfbAFgBFEFhtYhmA9moC5APdjBfjhQ8mGC5ty5P9ubymyCXvmmPQZCheKlSNU9NKLqpV11btdW8FLqQMK4WCgZAGUrnwcdZCoIRa1sSTkG8WcXVg9hSNcA2zY5utMGpvbY25QM7mHUAl3Ava6Y49ObNahURW9cdBaprYox9i4Lm7zwZD')
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
