<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SaleResource\Pages;
use App\Filament\Resources\SaleResource\RelationManagers;
use App\Models\Category;
use App\Models\Sale;
use App\Models\Service;
use App\Models\Tenant;
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
    protected static ?string $pluralLabel = 'Compras';
    protected static ?string $label = 'Comprar';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('category_id')
                    ->label('Categoria')
                    ->live() // ou ->reactive() nas versões mais novas do Filament
                    ->placeholder('Informe a categoria')
                    ->options(function () {
                        $categories = Category::query()
                            ->withMin('services', 'rate') // cria a coluna virtual `services_min_rate`
                            // empurra categorias SEM serviços para o final e ordena pelas mais baratas
                            ->orderByRaw('CASE WHEN services_min_rate IS NULL THEN 1 ELSE 0 END')
                            ->orderBy('services_min_rate')
                            ->get(['id', 'name']);

                        return $categories->mapWithKeys(function ($cat) {
                            $label = $cat->services_min_rate !== null
                                ? sprintf('%s — a partir de R$ %s',
                                    $cat->name,
                                    number_format($cat->services_min_rate / 100, 2, ',', '.')
                                )
                                : sprintf('%s — sem serviços', $cat->name);

                            return [$cat->id => $label];
                        })->toArray();
                    }),

                Forms\Components\Select::make('service_id')
                    ->label('Escolha o serviço')
                    ->placeholder('Veja as opções')
                    ->live()
                    ->preload()
                    ->options(function (Get $get) {
                        if (!$get('category_id')) {
                            return [];
                        }


                        return Service::when(!Auth::user()->hasRole('SUPER'), function (Builder $query) use ($get) {
                            $tenant = Tenant::where('url', request()->getHost())->first();

                            return $query->where('category_id', $get('category_id'))
                                ->where('user_id', $tenant->user_id);
                        }, function ($query) use ($get) {
                            return $query->where('category_id', $get('category_id'))
                                ->where('user_id', 2);
                        })->get()
                            ->mapWithKeys(function ($service) {

                                $rateFormatted = number_format($service->rate / 100, 2, ',', '.');


                                $label = "{$service->name} - R$ {$rateFormatted}";


                                return [$service->id => $label];
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
                        Forms\Components\TextInput::make('quantity')
                            ->reactive()
                            ->label(function (Get $get) {

                                $serviceId = $get('service_id');
                                $quantity = $get('quantity') ?? 0;

                                if (!$serviceId) {
                                    return "Quantidade: Valor R$ 0,00";
                                }

                                $service = Service::find($serviceId);
                                if (!$service || !$quantity) {
                                    return "Quantidade: Valor R$ 0,00";
                                }

                                $total = ($service->rate / 100) * $quantity; // rate vem em centavos

                                return "Quantidade: Valor R$ " . number_format($total / 1000, 2, ',', '.') ?? 0;
                            })
                            ->minValue(function (Get $get) {

                                if ($get('service_id')) {
                                    $service = Service::find($get('service_id'));

                                    return $service->min;
                                }

                            })
                            ->placeholder(function (Get $get) {
                                if ($get('service_id')) {
                                    $services = Service::find($get('service_id'));

                                    return 'Quantidade mínima: ' . $services->min;
                                }

                            })
                            ->required()
                            ->numeric(),
                        Forms\Components\TextInput::make('link')
                            ->label('Link da rede social que vai receber o serviço')
                            ->required()
                            ->maxLength(255),
                    ])

            ]);
    }

    public static function table(Table $table): Table
    {

        return $table
            ->defaultSort('created_at', 'desc')
            ->modifyQueryUsing(fn(Builder $query) => Auth::user()->hasRole('ADMIN') ?
                $query :
                $query->where('user_id', Auth::id()))
            ->columns([
                Tables\Columns\TextColumn::make('user.name')
                    ->label('Cliente')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('totalValue')
                    ->label('Valor')
                    ->money('BRL', 100)
                    ->sortable(),
                     Tables\Columns\TextColumn::make('status')
                    ->label('Status')
                    ->sortable(),

                Tables\Columns\TextColumn::make('created_at')
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
