<?php

namespace App\Filament\Resources;

use App\Filament\Resources\WithdrawResource\Pages;
use App\Filament\Resources\WithdrawResource\RelationManagers;
use App\Models\Withdraw;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Leandrocfe\FilamentPtbrFormFields\Money;
use Illuminate\Support\Facades\Auth;

class WithdrawResource extends Resource
{
    protected static ?string $model = Withdraw::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';


    protected static ?string $navigationGroup = 'Financeiro';

    protected static ?string $label = 'Histórico de Saques';


     public static ?string $getNavigationUrl  = 'create';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([

                Money::make('value')
                    ->maxValue(function(){
                        return 878;
                    })
                    ->dehydrateMask()
                    ->prefix('R$')
                    ->label(function(){
                        return 'Informe o valor do saque';
                    })
                    ->helperText(function(){
                        return 'Saldo disponível: R$ 190,00';
                    })
                    ->columnSpanFull()
                    ->required(),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->modifyQueryUsing(function (Builder $query){
                $query->when(Auth::user()->hasRole('SUPER'), function () use ($query){
                    return $query;
                }, function ($query) {
                   return $query->where('user_id', Auth::id());
                });
            })
            ->columns([
                Tables\Columns\TextColumn::make('user.name')
                    ->visible(function (){
                        return Auth::user()->hasRole('SUPER');
                    })
                    ->sortable(),
                Tables\Columns\TextColumn::make('value')
                    ->label('Valor')
                    ->money('BRL', 100)
                    ->sortable(),
                Tables\Columns\TextColumn::make('status')
                    ->searchable(),

            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListWithdraws::route('/'),
            'create' => Pages\CreateWithdraw::route('/create'),
            'edit' => Pages\EditWithdraw::route('/{record}/edit'),
        ];
    }
}
