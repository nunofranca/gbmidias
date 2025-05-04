<?php

namespace App\Providers;


use App\Services\APIs\GPT\GptService;
use App\Services\APIs\GPT\GptServiceInterface;
use App\Services\APIs\WhatsApp\WhatsAppService;
use App\Services\APIs\WhatsApp\WhatsAppServiceInterface;
use App\Services\Ask\AskService;
use App\Services\Ask\AskServiceInterface;
use App\Services\Client\ClientService;
use App\Services\Client\ClientServiceInterface;
use App\Services\Response\ResponseService;
use App\Services\Response\ResponseServiceInterface;
use App\Services\Sale\SaleService;
use App\Services\Sale\SaleServiceInterface;
use App\Services\Service\ServiceService;
use App\Services\Service\ServiceServiceInterface;
use Illuminate\Support\ServiceProvider;

class ServiceServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(WhatsAppServiceInterface::class, WhatsAppService::class);
        $this->app->bind(ClientServiceInterface::class, ClientService::class);
        $this->app->bind(AskServiceInterface::class, AskService::class);
        $this->app->bind(ResponseServiceInterface::class, ResponseService::class);
        $this->app->bind(ServiceServiceInterface::class, ServiceService::class);
        $this->app->bind(SaleServiceInterface::class, SaleService::class);
    

        //gpt
        $this->app->bind(GptServiceInterface::class, GptService::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
