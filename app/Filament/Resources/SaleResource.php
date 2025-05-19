<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SaleResource\Pages;
use App\Filament\Resources\SaleResource\RelationManagers;
use App\Models\Category;
use App\Models\Sale;
use App\Models\Service;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;

class SaleResource extends Resource
{
    protected static ?string $model = Sale::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $pluralLabel = 'Pedidos';
    protected static ?string $label = 'Pedido';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('category_id')
                    ->live()
                    ->label('Categoria')
                    ->options(Category::get()->pluck('name', 'id'))
                    ->placeholder('Informe a categoria'),
                Forms\Components\Select::make('services')
                    ->label('Escolha o serviço')
                    ->placeholder('Veja as opções')
                    ->live()
                    ->preload()
                    ->options(function (Get $get) {
                        if (!$get('category_id')) {
                            return [];
                        }

                        return Service::where('category_id', $get('category_id'))
                            ->get()
                            ->mapWithKeys(function ($service) {
                                return [
                                    $service->id => "{$service->name} - R$ " . number_format($service->rate / 100, 2, ',', '.'),
                                ];
                            })
                            ->toArray();
                    })
                    ->searchable()
                    ->required(),


                Forms\Components\Grid::make()
                    ->columns([
                        'sm' => 1,
                        'md' => 2
                    ])
                    ->schema([
                        Forms\Components\TextInput::make('totalValue')
                            ->label('Quantidade')
                            ->minValue(function (Get $get) {

                                if ($get('services')) {
                                    $services = Service::find($get('services'));
                                    return $services->min;
                                }

                            })
                            ->placeholder(function (Get $get) {
                                if ($get('services')) {
                                    $services = Service::find($get('services'));
                                    return 'Quantidade mínima: ' . $services->min;
                                }

                            })
                            ->required()
                            ->numeric(),
                        Forms\Components\TextInput::make('link')
                            ->label('Link ou @ da rede social que vai receber o serviço')
                            ->required()
                            ->maxLength(255),
                    ])

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
//            ->modifyQueryUsing(function (Builder $builder) {
//                return $builder->when(Auth::user()->hasRole('ADMIN'), function () use ($builder) {
//                    return $builder;
//
//                }, function () use ($builder) {
//                    return $builder->where('user_id', Auth::id());
//                });
//            })
            ->columns([
                Tables\Columns\TextColumn::make('user.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('totalValue')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('link')
                    ->searchable(),
                Tables\Columns\TextColumn::make('deleted_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageSales::route('/'),
        ];
    }
}
