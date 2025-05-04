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
        return Http::withToken('EAAmCXTP7IXgBO9ScP6SmN9MBQUxJZCTLvGiq56NCDqPtU7LZCCP4BzEmaGjRQomepf71T6BGmv9CrKHWeF451Y8a4JCfyZA98Nz7IW3FSFEkeEZBTNFUhRqjZBLu49r4H6hKAfrELfm0fMBH888w9CtWrAl48ixi7H9PbCr03WCsxdCaUahWwTIo0bwpb0p299xb8fs1dKwEshRZB3ZAFGaCRKXcHgZD')
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
