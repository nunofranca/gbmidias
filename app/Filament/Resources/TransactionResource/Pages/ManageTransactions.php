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
                        ->numeric()
                        ->label('Valor')
                        ->prefix('R$')
                        ->placeholder('Minimo R$ 10. Valor em reais. Não inform centavos')
                        ->required(),
                ])
                ->modalHeading('Pagamento PIX')
                ->modalSubmitActionLabel('Gerar')
                ->modalCancelActionLabel('Fechar')
                ->action(function (array $data, Actions\Action $action): void {

                    $response = Http::pushinpay()->post('/pix/cashIn', [
                        'value' => Str::remove(['.', '-', ' '], $data['balance'])*100,
                        'webhook_url' => 'https://gbmidias.shop/api/webhook/pushinpay/autoatendimento',
                        'expires_at' => now()->addMinutes(15),
                    ])->json();

                    Transaction::create([
                        'client_id' => Auth::id(),
                        'paymentLinkUrl' =>$response['qr_code'],
                        'correlationID' =>  $response['id'],
                        'value' => $response['value'],
                        'qrCodeImage' => $response['qr_code_base64'],
                    ]);



                    $qrCode = $response['qr_code_base64'] ?? null;

                    // Interrompe o fechamento do modal


                    // Atualiza o modal para exibir a view com o QR Code
                    $action->modalHeading('Pagamento PIX - QR Code');

                    $action->modalContent(fn () => view('qrcode', [
                        'qrCode' => $qrCode,
                    ]));
                    $action->halt();
                }),
        ];
    }
}
