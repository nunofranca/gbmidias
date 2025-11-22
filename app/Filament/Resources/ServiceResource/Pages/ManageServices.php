<?php

namespace App\Filament\Resources\ServiceResource\Pages;

use App\Filament\Resources\ServiceResource;
use App\Jobs\ModifyRateWithPercentJob;
use App\Models\Service;
use App\Services\Service\ServiceServiceInterface;
use Filament\Actions;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Pages\ManageRecords;
use Illuminate\Support\Facades\Auth;

class ManageServices extends ManageRecords
{
    protected static string $resource = ServiceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('tutorial')
                ->color('success')
                ->label('Ver Tutorial')
                ->url('https://meu-site.com/tutorial')
                ->openUrlInNewTab(),
            Actions\Action::make('price')
                ->label('Alterar valores')
                ->form([
                    TextInput::make('percent')
                        ->numeric()
                        ->suffix('%')
                        ->label('Valor em porcetangem')

                ])
                ->action(function (array $data, ServiceServiceInterface $serviceService): void {
                    $services = $serviceService->index();
                    $services->each(fn($service) =>
                    ModifyRateWithPercentJob::dispatch(Auth::user(), $service, $data['percent'])
                        ->onQueue('gbmidias-default'));
                })
        ];
    }
}
