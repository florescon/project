<?php

namespace App\Filament\Resources\Shop;

use App\Filament\Resources\Shop\FinanceResource\Pages;
use App\Filament\Resources\Shop\FinanceResource\RelationManagers;
use App\Models\Shop\Finance;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Section;


class FinanceResource extends Resource
{
    protected static ?string $model = Finance::class;

    protected static ?string $slug = 'shop/finances';

    protected static ?string $navigationGroup = 'Shop';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function getNavigationLabel(): string
    {
        return __('Finances');
    }

    public static function getModelLabel(): string
    {
        return __('Finance');
    }

    public static function getPluralLabel(): ?string
    {
        return static::getNavigationLabel();
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Ingresos y Egresos')
                    ->description('Registre los detalles de la transacción')
                    ->schema([
                        TextInput::make('qty')
                            ->label('Cantidad')
                            ->numeric()
                            ->required()
                            ->minValue(1)
                            ->disabled(fn (string $operation): bool => $operation === 'edit') // Deshabilita en edición
                            ->integer(),
                            
                        Textarea::make('comment')
                            ->label('Comentario')
                            ->columnSpanFull()
                            ->maxLength(500),
                            
                        Toggle::make('is_income')
                            ->label('¿Es ingreso?')
                            ->required()
                            ->default(true)
                            ->disabled(fn (Forms\Get $get, ?Finance $record): bool => 
                                    // Deshabilitar si hay un cash_id en el registro existente
                                    $record?->cash_id !== null
                            )
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
                Tables\Columns\TextColumn::make('id')
                    ->label(__('Folio'))
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('qty')
                    ->label(__('Quantity'))
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('comment')
                    ->label(__('Comment'))
                    ->searchable()
                    ->sortable(),

                Tables\Columns\BadgeColumn::make('is_income')
                    ->label(__('Tipo'))
                    ->colors([
                        'success' => true,
                        'danger' => false,
                    ])
                    ->formatStateUsing(fn (bool $state): string => $state ? 'Ingreso' : 'Egreso'),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label(__('Updated Date'))
                    ->date()
                    ->sortable(),
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
            'index' => Pages\ListFinances::route('/'),
            'create' => Pages\CreateFinance::route('/create'),
            'edit' => Pages\EditFinance::route('/{record}/edit'),
        ];
    }
}
