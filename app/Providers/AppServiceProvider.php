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
        return Http::withToken('EAAmCXTP7IXgBO8jo1JosBauZBATeS5ofnyCwk46U05HwfWZCi8Hv5uYmZAXF6f890lQb1p3bGysiprm8owWyAlVdbQrlPbYahImkvLzTY4uF8JIuTuPZCnJ16o8nl4jwf1lq74r2htkHC4vM0D9y8jxFEtHnejdypu765a96acUSxJ6xtBEKkhAtg8NdoygZByasZCvHdQ5wEdKX8SS7Vh8m1kUrnfPAZDZD')
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
