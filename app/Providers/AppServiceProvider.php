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
        return Http::withToken('EAAmCXTP7IXgBOyqvgvkutJHPeAxaIbCBg4klFwgYjxtI8luX4RFvuZAwf2JbTwVCjLwF5ZCyHdD1PB4tHykWNCGjXCa887onip75Lkxm0esNODQSsKZCfBidf2qof6O33uuZBCK8QAeoRogZBjOEPr0FvPZCBzZAZCpIV18KHXf51kpdXAP9k4ZCrDsBg90larOlApG88abDRQ1LaF2D9W68rZCaO4OktXEG4ZD')
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
