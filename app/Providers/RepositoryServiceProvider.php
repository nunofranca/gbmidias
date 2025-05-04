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
use App\Repositories\Service\ServiceRepositoryEloquent;
use App\Repositories\Service\ServiceRepositoryInterface;
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
        $this->app->bind(ServiceRepositoryInterface::class, ServiceRepositoryEloquent::class);

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
