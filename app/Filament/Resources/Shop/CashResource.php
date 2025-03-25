<?php

namespace App\Filament\Resources\Shop;

use App\Filament\Resources\Shop\CashResource\Pages;
use App\Filament\Resources\Shop\CashResource\RelationManagers;
use App\Models\Shop\Cash;
use App\Models\Shop\Order;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Blade;
use Illuminate\Database\Eloquent\Builder;
use Filament\Infolists\Components\Grid;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\Actions\Action;
use Illuminate\Support\HtmlString;

class CashResource extends Resource
{
    protected static ?string $model = Cash::class;

    protected static ?string $slug = 'shop/cashes';

    protected static ?string $recordTitleAttribute = 'name';

    protected static ?string $navigationGroup = 'Shop';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function getNavigationLabel(): string
    {
        return __('Cashes');
    }

    public static function getModelLabel(): string
    {
        return __('Cash');
    }

    public static function getPluralLabel(): ?string
    {
        return static::getNavigationLabel();
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // Mostrar el listado de órdenes con cash_id = null
                Forms\Components\Grid::make()
                    ->schema([
                        Forms\Components\TextInput::make('initial')
                            ->integer()
                            ->label(__('Initial'))
                            ->required()
                            ->maxLength(10),
                    ]),
                Forms\Components\Grid::make()
                    ->schema([
                        Forms\Components\TextInput::make('comment')
                            ->label(__('Comment'))
                            ->required()
                            ->maxLength(50),
                    ]),

                Forms\Components\Section::make('Órdenes')
                    ->headerActions([
                        Action::make('pdf')
                            ->label('PDF')
                            ->color('success')
                            ->action(function (Model $record) {
                                return response()->streamDownload(function () use ($record) {
                                    echo Pdf::loadHtml(
                                        Blade::render('cash-pdf', ['record' => $record])
                                    )->setPaper([0, 0, 2385.98, 296.85], 'landscape')->stream();
                                }, 'Corte de caja #'.$record->id . '.pdf');
                            }),


                    ])
                    ->schema([
                        Forms\Components\Grid::make()
                            ->columns(['xl' => 6])
                            ->schema(function ($record) {

                                // Usar las órdenes ya cargadas por eager loading
                                $orders = $record?->orders ?? Order::with('items', 'pizzas')->whereNull('cash_id')->get();
                                
                                return $orders->map(function ($order) {
                                    return Forms\Components\Placeholder::make('order_' . $order->id)
                                        ->label('Orden #' . $order->id)
                                        ->content(new HtmlString('<strong>$' . number_format($order->total_order, 2) . '</strong> <br> ' .$order->created_at->isoFormat('D, MMM h:mm:ss a'))); // Formato de moneda
                                })->toArray();

                            }),
                    ])
            ]);
    }
    
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label(__('Folio'))
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('initial')
                    ->label(__('Initial'))
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('comment')
                    ->label(__('Comment'))
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('user.name')
                    ->label(__('Created by'))
                    ->searchable()
                    ->sortable()
                    ->toggleable(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label(__('Updated Date'))
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label(__('Created'))
                    ->date()
                    ->sortable(),
                //
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                // Tables\Actions\BulkActionGroup::make([
                //     Tables\Actions\DeleteBulkAction::make(),
                // ]),
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
            'index' => Pages\ListCashes::route('/'),
            'create' => Pages\CreateCash::route('/create'),
            'edit' => Pages\EditCash::route('/{record}/edit'),
        ];
    }
}
