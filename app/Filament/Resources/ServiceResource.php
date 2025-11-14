<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ServiceResource\Pages;
use App\Filament\Resources\ServiceResource\RelationManagers;
use App\Models\Service;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ServiceResource extends Resource
{
    protected static ?string $model = Service::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $pluralLabel= 'Serviços';
    protected static ?string $label= 'Serviço';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label('Nome')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('type')
                    ->label('Tipo')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('rate')
                    ->label('Valor')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('min')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('max')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Toggle::make('dripfeed')
                    ->required(),
                Forms\Components\Toggle::make('refill')
                    ->required(),
                Forms\Components\Toggle::make('cancel')
                    ->required(),
                Forms\Components\TextInput::make('category')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Toggle::make('status')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->modifyQueryUsing(function (Builder $query) {
                $query->where('user_id', Auth::id());
            })
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Nome')
                    ->searchable(),
                Tables\Columns\TextColumn::make('type')
                    ->label('Tipo')
                    ->searchable(),
                    Tables\Columns\TextColumn::make('coast')
                    ->label('Custo')
                    ->money('BRL', 100)
                    ->searchable(),
                Tables\Columns\TextInputColumn::make('rate')
                     ->label('Venda')
                    ->searchable(),
                Tables\Columns\TextColumn::make('min')
                    ->label('Compra mínima')
                    ->searchable(),
                Tables\Columns\ToggleColumn::make('status')
                    ->label('Status'),
            ])
            ->filters([
                //
            ])
            ->actions([

            ])
            ->bulkActions([

            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageServices::route('/'),
        ];
    }
}
