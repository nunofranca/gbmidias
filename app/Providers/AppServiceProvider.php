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
        return Http::withToken('EAAmCXTP7IXgBOxV6JM9BriNZBVNovOidqcFrR8EIlSFDA4hzaOp5uFlTocVFYoIrlphWHyfTiQZBGVCgtbDWHmili8TOUyJ6RcmGmMSo3N6TL3ZCTPooJZBdt4NOCcbMHLBvYaBBWcZC1BpCT0ghpICI3l8fbEadlxHZCvV23vVS6zna0DNviniYSJJ6EKaUxuHmMJ4E5ZAkURZCP1DHO1oZAsns6WE0ZD')
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
