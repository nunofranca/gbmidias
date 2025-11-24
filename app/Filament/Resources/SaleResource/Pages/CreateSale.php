<?php

namespace App\Filament\Resources\SaleResource\Pages;

use App\Filament\Resources\SaleResource;
use Filament\Actions;
use Filament\Actions\Action;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Str;

class CreateSale extends CreateRecord
{
    protected static string $resource = SaleResource::class;
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
    public function getTitle(): string
    {
        return 'Comprar';
    }
    protected function getFormActions(): array
    {
        return [
            Action::make('save')
                ->label('Comprar') // ✅ muda o texto
                ->submit('create'),
        ];
    }
}
