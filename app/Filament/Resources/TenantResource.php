<?php

namespace App\Filament\Resources;

use App\Enum\StatusPaymentEnum;
use App\Filament\Resources\TenantResource\Pages;
use App\Filament\Resources\TenantResource\RelationManagers;
use App\Models\Tenant;
use App\Models\User;
use Faker\Provider\en_UG\PhoneNumber;
use Filament\Actions\Action;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;

class TenantResource extends Resource
{
    protected static ?string $model = Tenant::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form;

    }

    public static function table(Table $table): Table
    {
        return $table
            ->modifyQueryUsing(function (Builder $query) {
                $query->when(Auth::user()->hasRole('ADMIN'), function ($query) {
                    return $query;
                }, function ($query) {
                    return $query->where('user_id', Auth::id());
                })->get();
            })
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('url')
                    ->searchable(),
                Tables\Columns\TextColumn::make('status')
                    ->label('status'),
                Tables\Columns\TextColumn::make('message')
                    ->label('Mensagem')
                    ->searchable(),


                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\Action::make('status')
                    ->label('Aprovar')
                    ->form([
                        Forms\Components\Select::make('status')
                        ->options([
                            'recusado' => 'RECUSAR',
                            'aprovado' => 'APROVAR',
                        ])
                    ])
                    ->visible(function (Tenant $tenant) {
                        return $tenant->status == StatusPaymentEnum::PAID->value and Auth::user()->hasRole('SUPER ADMIN');
                    })
                    ->action(function (array $data, Tenant $tenant) {

                        $tenant->update(['status' => $data['status'], 'message' => $data['status']]);
                    }),
                Tables\Actions\Action::make('QRCODE')
                    ->visible(function (Tenant $tenant) {
                        return $tenant->status == StatusPaymentEnum::PENDING->value;
                    })
                    ->label('Ver QRcode')
                    ->modalHeading('Pagamento PIX')
                    ->modalSubmitActionLabel('Pagar')
                    ->modalCancelActionLabel('Fechar')
                    ->modalHeading('Pagamento PIX - QR Code')
                    ->modalContent(fn(Tenant $tenant) => view('qrcode', [
                        'qrCode' => $tenant->qrCodeImage,
                        'paymentLink' => $tenant->paymentLinkUrl,
                    ]))
            ])
            ->bulkActions([

    ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageTenants::route('/'),
        ];
    }
}
