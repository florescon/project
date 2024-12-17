<?php

namespace App\Filament\Resources\CommentResource\Widgets;

use App\Filament\Resources\CommentResource;
use App\Filament\Resources\Shop\OrderResource;
use App\Models\Comment;
use App\Models\Shop\Order;
use Filament\Actions\EditAction;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class LatestCommentsWidget extends BaseWidget
{
    protected static ?string $heading = 'Últimos Pedidos';

    protected int | string | array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        return $table
            ->query(
                Order::whereDate('created_at', '>', now()->subDays(70)->startOfDay())->orderBy('created_at', 'desc')
            )
            ->columns([
                TextColumn::make('number')
                    ->label(__('Number')),
                TextColumn::make('user.name')
                    ->label(__('Customer')),
                TextColumn::make('created_at')->date()->sortable()
                    ->label(__('Created at')),
            ])
            ->actions([
                Action::make('View')
                    ->url(fn (Order $record): string => OrderResource::getUrl('edit', ['record' => $record]))
                    ->openUrlInNewTab()
            ]);
    }
}
