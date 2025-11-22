<?php

namespace App\Filament\Resources\ConfigResource\Pages;

use App\Filament\Resources\ConfigResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Support\Facades\Auth;

class ListConfigs extends ListRecords
{
    protected static string $resource = ConfigResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
            ->visible(fn() =>!Auth::user()->config()->exists()),
        ];
    }
}
