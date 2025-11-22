<?php

namespace App\Providers\Filament;

use App\Filament\Pages\Login;
use App\Filament\Pages\Register;
use App\Filament\Resources\SaleResource;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Navigation\NavigationItem;
use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Widgets;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use App\Filament\Resources\WithdrawResource;


class PainelPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('painel')
            ->path('painel')
            ->registration()
            ->login(Login::class)
            ->colors([
                'primary' => Color::Amber,
            ])
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->pages([
                Pages\Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            ->widgets([
                Widgets\AccountWidget::class,
                Widgets\FilamentInfoWidget::class,
            ])
            ->navigationItems([
                NavigationItem::make('Comprar')
                    // Use forPanel() to set the context before calling getUrl()
                    ->url(fn() => SaleResource::getUrl('create'))
                    ->icon('heroicon-o-presentation-chart-line')
                    ->isActiveWhen(fn() => request()->routeIs('filament.painel.resources.withdraws.create'))
                    ->group('Pedidos'),
                NavigationItem::make('Histórico de Compras')
                    // Use forPanel() to set the context before calling getUrl()
                    ->url(fn() => SaleResource::getUrl())
                    ->icon('heroicon-o-presentation-chart-line')
                    ->isActiveWhen(fn() => request()->routeIs('filament.painel.resources.withdraws.create'))
                    ->group('Pedidos'),
                NavigationItem::make('Realizar Saque')
                    // Use forPanel() to set the context before calling getUrl()
                    ->url(fn() => WithdrawResource::getUrl('create'))
                    ->visible(function (){

                        return Auth::user()->hasRole('ADMIN');
                    })
                    ->icon('heroicon-o-presentation-chart-line')
                    ->isActiveWhen(fn() => request()->routeIs('filament.painel.resources.withdraws.create'))
                    ->group('Financeiro'),

                NavigationItem::make('Histótico de saques')
                    // Use forPanel() to set the context before calling getUrl()
                    ->url(fn() => WithdrawResource::getUrl('index'))
                    ->icon('heroicon-o-presentation-chart-line')
                    ->isActiveWhen(fn() => request()->routeIs('filament.painel.resources.withdraws.index'))
                    ->visible(function (){

                        return Auth::user()->hasRole(['ADMIN', 'SUPER']);
                    })
                    ->group('Financeiro'),

                NavigationItem::make()
                    ->label('GB Proxy')
                    ->url('https://www.gbproxys.com.br/')
                    ->icon('heroicon-o-book-open')
                    ->group('Links Úteis')
                    ->openUrlInNewTab(),
                NavigationItem::make()
                    ->label('Suporte')
                    ->url('https://wa.me/5511918204396?text=Opa,+preciso+de+suporte')
                    ->icon('heroicon-o-book-open')
                    ->group('Links Úteis')
                    ->openUrlInNewTab(),
                NavigationItem::make()
                    ->label('Instagram')
                    ->url('https://www.instagram.com/gbmidiassocias?igsh=MWxibTcyY3RvdHludg%3D%3D&utm_source=qr')
                    ->icon('heroicon-o-book-open')
                    ->group('Links Úteis')
                    ->openUrlInNewTab(),
                NavigationItem::make()
                    ->label('Como funciona')
                    ->url('https://youtube.com/shorts/_98Vbia7MTY?si=DAZmAW0q0r5rYBr9 ')
                    ->icon('heroicon-o-book-open')
                    ->group('Links Úteis')
                    ->openUrlInNewTab(),
            ])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->authMiddleware([
                Authenticate::class,
            ]);
    }
}
