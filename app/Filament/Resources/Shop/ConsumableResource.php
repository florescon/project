<?php

namespace App\Filament\Resources\Shop;

use App\Filament\Resources\Shop\ConsumableResource\Pages;
use App\Filament\Resources\Shop\ConsumableResource\RelationManagers;
use App\Models\Shop\Consumable;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;


use Filament\Tables\Actions\Action;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Section;

class ConsumableResource extends Resource
{
    protected static ?string $model = Consumable::class;

    protected static ?string $slug = 'shop/consumable';

    protected static ?string $navigationGroup = 'Shop';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function getNavigationLabel(): string
    {
        return __('Consumables');
    }

    public static function getModelLabel(): string
    {
        return __('Consumable');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Consumible')
                    ->description('Registre los consumibles')
                    ->schema([
                        TextInput::make('name')
                            ->label(__('Name'))
                            ->required(),
                        TextInput::make('unit')
                            ->label(__('Unit'))
                            ->required(),
                            
                        Textarea::make('description')
                            ->label(__('Description'))
                            ->columnSpanFull()
                            ->maxLength(500),

                        TextInput::make('price')
                            ->label(__('Price'))
                            ->numeric()
                            ->required()
                            ->minValue(1)
                            ,
                            
                        TextInput::make('stock')
                            ->label(__('Existencia'))
                            ->numeric()
                            ->required()
                            ->minValue(1)
                            ->disabled(fn (string $operation): bool => $operation === 'edit') // Deshabilita en edición
                            ,

                        Toggle::make('active')
                            ->label('Activo')
                            ->required()
                            ->default(true)
                            ->onColor('success')
                            ->offColor('danger'),
                    ])
                    ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label(__('Name'))
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('description')
                    ->label(__('Description'))
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('stock')
                    ->label(__('Existencia'))
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('unit')
                    ->label(__('Unit'))
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('price')
                    ->label(__('Price'))
                    ->searchable()
                    ->sortable(),
                Tables\Columns\BadgeColumn::make('active')
                    ->label(__('Active'))
                    ->colors([
                        'success' => true,
                        'danger' => false,
                    ])
                    ->formatStateUsing(fn (bool $state): string => $state ? 'Activo' : 'Inactivo'),
                Tables\Columns\TextColumn::make('created_at')
                    ->label(__('Created'))
                    ->date()
                    ->sortable(),

            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Action::make('addStock')
                    ->label('Añadir Stock')
                    ->icon('heroicon-o-plus')
                    ->form([
                        TextInput::make('quantity')
                            ->label('Cantidad')
                            ->numeric()
                            ->required()
                            ->minValue(1),
                    ])
                    ->action(function (Consumable $record, array $data): void {
                        $record->increment('stock', $data['quantity']);
                    }),
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
            'index' => Pages\ListConsumables::route('/'),
            'create' => Pages\CreateConsumable::route('/create'),
            'edit' => Pages\EditConsumable::route('/{record}/edit'),
        ];
    }
}
