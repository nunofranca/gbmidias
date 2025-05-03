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
        return Http::withToken('EAAmCXTP7IXgBOz6ZBKuRCKlaqL7CAMM11FGAZCC0RnAA1XCOMZC69FbZABKHRiZB9C8xd3ebZAJqJFhNZCTjPPAYl3nKymZA7VlPwbNpV8eqbCpVshZBjtiZCFSaZBVnyiqVFC5eXajaMVsNXA41sfjURqAGgmSZADrIHHP3oTEKWqEH8GVWnZCCgi48RT0WjZCoAF01wXhnUHqbHDCGGYVkRcpHLzJHVm4IAk')
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
