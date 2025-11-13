<?php

namespace App\Filament\Resources\TransactionResource\Pages;

use App\Filament\Resources\TransactionResource;
use App\Models\Transaction;
use Filament\Actions;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Pages\ManageRecords;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class ManageTransactions extends ManageRecords
{
    protected static string $resource = TransactionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->label('Adicionar Saldo')
                ->color('info')
                ->form([
                    TextInput::make('balance')
                        ->minValue(10)
                        ->maxValue(150)
                        ->numeric()
                        ->label('Valor')
                        ->prefix('R$')
                        ->placeholder('Minimo R$ 10. Valor em reais. Não informar centavos')
                        ->required(),
                ])
                ->modalHeading('Pagamento PIX')
                ->modalSubmitActionLabel('Gerar')
                ->modalCancelActionLabel('Fechar')
                ->action(function (array $data, Actions\Action $action): void {

                    // 1️⃣ Gera o PIX via API PushinPay
                    $response = Http::pushinpay()->post('/pix/cashIn', [
                        'value' => Str::remove(['.', '-', ' '], $data['balance']) * 100,
                        'webhook_url' => 'https://gbmidias.shop/api/webhook/pushinpay/autoatendimento',
                        'expires_at' => now()->addMinutes(15),
                    ])->json();

                    // 2️⃣ Captura UTMs da session
                    $utm_source   = session('utm_source');
                    $utm_medium   = session('utm_medium');
                    $utm_campaign = session('utm_campaign');
                    $utm_term     = session('utm_term');
                    $utm_content  = session('utm_content');
                    $xcod         = session('xcod');

                    // 3️⃣ Salva a transação no banco
                    $transaction = Transaction::create([
                        'paymentLinkUrl' => $response['qr_code'] ?? null,
                        'correlationID'  => $response['id'] ?? null,
                        'value'          => $response['value'] ?? null,
                        'qrCodeImage'    => $response['qr_code_base64'] ?? null,
                        'utm_source'     => $utm_source,
                        'utm_medium'     => $utm_medium,
                        'utm_campaign'   => $utm_campaign,
                        'utm_term'       => $utm_term,
                        'utm_content'    => $utm_content,
                        'xcod'           => $xcod,
                    ]);

                    // 4️⃣ Monta payload para a UTMify
                    $cliente = [
                        'name' => Auth::user()->name ?? 'Cliente Teste',
                        'email' => Auth::user()->email ?? 'teste@email.com',
                        'phone' => Auth::user()->phone ?? 21969873741,
                        'document' => '07068093868',
                        'country' => 'BR',
                        'ip' => request()->ip(),
                    ];

                    $utmifyPayload = [
                        'orderId' => $response['id'] ?? uniqid('pix_'),
                        'platform' => 'BACKEND - MEDZDEVELOPER',
                        'paymentMethod' => 'pix',
                        'status' => 'waiting_payment',
                        'createdAt' => gmdate('Y-m-d H:i:s'),
                        'approvedDate' => null,
                        'refundedAt' => null,
                        'customer' => $cliente,
                        'products' => [[
                            'id' => uniqid('prod_'),
                            'planId' => null,
                            'planName' => null,
                            'name' => 'Saldo - GB Mídias',
                            'quantity' => 1,
                            'priceInCents' => intval($response['value'] ?? 0)
                        ]],
                        'trackingParameters' => [
                            'utm_source' => $utm_source,
                            'utm_campaign' => $utm_campaign,
                            'utm_medium' => $utm_medium,
                            'utm_content' => $utm_content,
                            'utm_term' => $utm_term,
                            'xcod' => $xcod,
                        ],
                        'commission' => [
                            'totalPriceInCents' => intval($response['value'] ?? 0),
                            'gatewayFeeInCents' => intval(($response['value'] ?? 0) * 0.04),
                            'userCommissionInCents' => intval(($response['value'] ?? 0) * 0.96),
                        ],
                        'isTest' => false,
                    ];

                    // 5️⃣ Envia para a UTMify
                    $utmifyResponse = Http::withHeaders([
                        'Content-Type' => 'application/json',
                        'x-api-token' => 'BXVlTy6sfwWdvXi5EkGBVFQdCMwM6WPLLYPQ'
                    ])->post('https://api.utmify.com.br/api-credentials/orders', $utmifyPayload);

                    // 6️⃣ Log opcional da resposta da UTMify
                    \Log::info('UTMify Response', [
                        'body' => $utmifyResponse->body(),
                        'status' => $utmifyResponse->status()
                    ]);

                    // 7️⃣ Exibe QR Code no modal
                    $qrCode = $response['qr_code_base64'] ?? null;
                    $paymentLink = $response['qr_code'] ?? null;

                    $action->modalHeading('Pagamento PIX - QR Code');
                    $action->modalContent(fn () => view('qrcode', [
                        'qrCode' => $qrCode,
                        'paymentLink' => $paymentLink,
                    ]));
                    $action->halt();
                }),
        ];
    }
}
