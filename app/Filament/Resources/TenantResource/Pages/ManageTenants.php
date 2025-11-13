<?php

namespace App\Filament\Resources\TenantResource\Pages;

use App\Filament\Resources\TenantResource;
use App\Models\Tenant;
use App\Models\Transaction;
use Filament\Actions;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Pages\ManageRecords;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class ManageTenants extends ManageRecords
{
    protected static string $resource = TenantResource::class;

    protected function getHeaderActions(): array
    {
        return [

            Actions\CreateAction::make()
                ->label('Ativa loja')
                ->form([
                    TextInput::make('name')
                        ->required()
                        ->maxLength(255),
                    TextInput::make('url')
                        ->required()
                        ->maxLength(255),
                    Select::make('user_id')
                        ->relationship('user', 'name')
                        ->searchable(['email', 'name'])
                        ->preload()
                        ->visible(function () {
                            return Auth::user()->hasRole('ADMIN');
                        })
                ])
                ->modalHeading('Pagamento PIX')
                ->modalSubmitActionLabel('Gerar')
                ->modalCancelActionLabel('Fechar')
                ->action(function (array $data, Actions\Action $action): void {



                    // 1️⃣ Gera o PIX via API PushinPay
                    $response = Http::pushinpay()->post('/pix/cashIn', [
                        'value' => 100,
                        'webhook_url' => 'https://gbmidias.shop/api/webhook/pushinpay/autoatendimento',
                        'expires_at' => now()->addDay(),
                    ])->json();
                    $qrCode = $response['qr_code_base64'] ?? null;
                    $paymentLink = $response['qr_code'] ?? null;
                       Tenant::create([
                           'url'=> $data['url'],
                           'name' => $data['name'],
                           'user_id' => Auth::id(),
                           'paymentLinkUrl' => $response['qr_code'] ?? null,
                           'correlationID'  => $response['id'] ?? null,
                           'value'          => $response['value'] ?? null,
                           'qrCodeImage'    => $response['qr_code_base64'] ?? null,
                       ]);

                    $action->modalHeading('Pagamento PIX - QR Code');
                    $action->modalContent(fn() => view('qrcode', [
                        'qrCode' => $qrCode,
                        'paymentLink' => $paymentLink,
                    ]));
                    $action->halt();
                }),
        ];
    }
}
