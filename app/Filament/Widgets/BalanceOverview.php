<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\Auth;

class BalanceOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Seu Saldo R$ ', number_format(Auth::user()->balance, 2, '.', ','))
                ->chart([7, 2, 10, 3, 15, 4, 17])
                ->color('success'),
        ];
    }
}
