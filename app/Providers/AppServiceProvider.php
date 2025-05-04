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
        return Http::withToken('EAAmCXTP7IXgBOZCXMLJ65TDDnMZBqKXZAjK9W7l5upBdOAa97BZC4vdgXZBxUC9uhkAUX4YHSa9n6pAL3cbA4V7Mpqg5ZC7JYNamyW1VhfrYzjJXByq6jOQrze4kfvBog75kACTLyvXAPZChA3V8lnvPd8fZC1Vhe7lsva9YRGQGQ13FZAVFihsFWpghPK7x1cdOU95ZA7fV0728NReT8xBP88wYFBZCxUZD')
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
