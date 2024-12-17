<?php

namespace App\Filament\Resources\Shop\CustomerResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;
use App\Models\Shop\Order;

class OrdersRelationManager extends RelationManager
{
    protected static string $relationship = 'orders';

    protected static ?string $recordTitleAttribute = 'number';

    public function isReadOnly(): bool
    {
        return true;
    }

    public static function getTitle(Model $ownerRecord, string $pageClass): string
    {
        return __('Orders');
    }

    public static function getModelLabel(): string
    {
        return __('Order');
    }

    public static function getPluralLabel(): ?string
    {
        return static::getNavigationLabel();
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('number')
                    ->label(__('Number')),
                Forms\Components\Placeholder::make('status')
                    ->content(function (Get $get): string {
                        return $get('status') ? __(ucfirst($get('status'))) : '';
                    })
                    ->label(__('Status')),
                Forms\Components\Select::make('user_id')
                    ->relationship('user', 'name')
                    ->label(__('Customer')),
                Forms\Components\Placeholder::make('total_order')
                    ->label(__('Total'))
                    ->content(fn (Order $record): ?string => '$' . $record->total_order),
                Forms\Components\TextInput::make('shipping_price')
                    ->label(__('Shipping'))
                    ->required(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('number')
            ->columns([
                Tables\Columns\TextColumn::make('number')
                    ->searchable()
                    ->label(__('Number')),

                Tables\Columns\TextColumn::make('status')
                    ->label(__('Status'))
                    ->badge(),
                Tables\Columns\TextColumn::make('created_at_time')
                    ->label(__('Hour')),
                Tables\Columns\TextColumn::make('total_order')
                    ->label(__('Total')),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
