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
        return Http::withToken('EAAmCXTP7IXgBO0FUttWYzyUg5GOlCo7NRH0hCqCsyfYWnlliESSQGwNMXxcyKtsrP3ilq4Ned3OZC5mxODRIsTJdnuvmWGUgxiIRb5S0HM8EWwOZC4LmAfduN7IJwxuhm3broKz5TkLOchxIeos7MWVSuwwsSmrEUf9TbMwWiqEBahP2wUtTRdpOZAxaETJqZCXJZAgLBSYbZCcmSbY0PTvS9xS8IZD')
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
