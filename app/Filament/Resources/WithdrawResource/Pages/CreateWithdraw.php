<?php

namespace App\Filament\Resources\WithdrawResource\Pages;

use App\Filament\Resources\WithdrawResource;
use Filament\Actions;
use Filament\Actions\Action;
use Filament\Forms\Get;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Str;

class CreateWithdraw extends CreateRecord
{
    protected static string $resource = WithdrawResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getFormActions(): array
    {
        return [
            Action::make('save')
                ->label('Sacar') // ✅ muda o texto
                ->submit('create')
                ->disabled(function () {

                    return Str::remove(['.', ','], $this->form->getState()['value']) < 1000 || is_null($this->form->getState()['name']) || is_null($this->form->getState()['keyPix']);

                })
                ->color('primary'),
        ];
    }
}
