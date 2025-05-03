<?php

namespace App\Providers;

use App\Repositories\APIs\GPT\GptRepository;
use App\Repositories\APIs\GPT\GptRepositoryInterface;
use App\Repositories\APIs\WhatsApp\WhatsAppRepository;
use App\Repositories\APIs\WhatsApp\WhatsRepositoryInterface;
use App\Repositories\Ask\AskRepositoryEloquent;
use App\Repositories\Ask\AskRepositoryInterface;
use App\Repositories\Client\ClientRepositoryEloquent;
use App\Repositories\Client\ClientRepositoryInterface;
use App\Repositories\Response\ResponseRepositoryInterface;
use App\Repositories\Response\ResponseRespositoryEloquent;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(WhatsRepositoryInterface::class, WhatsAppRepository::class);

        $this->app->bind(ClientRepositoryInterface::class, ClientRepositoryEloquent::class);
        $this->app->bind(AskRepositoryInterface::class, AskRepositoryEloquent::class);
        $this->app->bind(ResponseRepositoryInterface::class, ResponseRespositoryEloquent::class);


        //gpt
        $this->app->bind(GptRepositoryInterface::class, GptRepository::class);


    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
