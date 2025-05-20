<?php

namespace App\Filament\Widgets;

use App\Enum\StatusPaymentEnum;
use App\Models\Sale;
use App\Models\Transaction;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\Auth;

class SaleChart extends ChartWidget
{
    protected static ?string $heading = 'Produtos mais vendidos';
    public static function canView(): bool
    {
        return Auth::user()?->hasRole('ADMIN');
    }
    protected function getData(): array
    {

        $sales = Sale::with('service')->where('status', StatusPaymentEnum::PAID)->get();

        $result = $sales
            ->groupBy('service.name')
            ->map(fn($group) => $group->count())->toArray();


        return [
            'datasets' => [
                [
                    'label' => 'Produtos mais vendidos',
                    'data' => array_values($result),
                    'backgroundColor' => array_values(config('graphicolores')),
                ],
            ],
            'labels' => array_keys($result),
        ];
    }

    protected function getType(): string
    {
        return 'pie';
    }
}
