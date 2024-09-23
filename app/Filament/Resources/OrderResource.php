<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OrderResource\Pages;
use App\Filament\Resources\OrderResource\Pages\ListOrders;
use App\Filament\Resources\Shop\OrderResource\Widgets\OrderStats;
use App\Models\Book;
use App\Models\Order;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\ToggleButtons;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Support\Number;

class OrderResource extends Resource
{
    protected static ?string $model = Order::class;

    protected static ?string $navigationGroup = 'Shop';

    protected static ?string $navigationIcon = 'heroicon-o-shopping-bag';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Group::make()->schema([
                    Section::make('Order Information')->schema([
                        Select::make('user_id')
                            ->label('Customer')
                            ->relationship('user', 'name')
                            ->searchable()
                            ->preload()
                            ->required(),
                        Select::make('payment_method')
                            ->options([
                                'transfer' => 'Transfer Bank',
                                'e-wallet' => 'E-Wallet',
                                'cod' => 'Cash On Delivery'
                            ])
                            ->label('Metode pembayaran')
                            ->required(),
                        Select::make('payment_status')
                            ->options([
                                'pending' => 'Pending',
                                'paid' => 'Paid',
                                'failed' => 'Failed'
                            ])
                            ->label('Status pembayaran')
                            ->default('pending')
                            ->required(),
                        ToggleButtons::make('status')
                            ->options([
                                'new' => 'New',
                                'processing' => 'Processing',
                                'shipped' => 'Shipped',
                                'delivered' => 'Delivered',
                                'cancelled' => 'Cancelled'
                            ])
                            ->colors([
                                'new' => 'info',
                                'processing' => 'warning',
                                'shipped' => 'success',
                                'delivered' => 'success',
                                'cancelled' => 'danger'
                            ])
                            ->icons([
                                'new' => 'heroicon-m-sparkles',
                                'processing' => 'heroicon-m-arrow-path',
                                'shipped' => 'heroicon-m-truck',
                                'delivered' => 'heroicon-m-check-badge',
                                'cancelled' => 'heroicon-m-x-circle'
                            ])
                            ->inline()
                            ->default('new')
                            ->required(),
                        Select::make('shipping_method')
                            ->options([
                                'jnt' => 'JNT',
                                'jne' => 'JNE',
                                'sicepat' => 'Si Cepat',
                                'lalamove' => 'LalaMove'
                            ])
                            ->label('Metode pengiriman'),
                        Textarea::make('notes')
                            ->label('Catatan')
                            ->columnSpanFull()
                    ])->columns(2),
                    Section::make('Order Buku')->schema([
                        Repeater::make('items')
                            ->relationship()
                            ->schema([
                            Select::make('book_id')
                                ->relationship('book', 'title')
                                ->label('Pilih Buku')
                                ->searchable()
                                ->preload()
                                ->required()
                                ->distinct()
                                ->disableOptionsWhenSelectedInSiblingRepeaterItems()
                                ->columnSpan(4)
                                ->reactive()
                                ->afterStateUpdated(fn ($state, Set $set) => $set('unit_price', optional(Book::find($state))->price ?? 0))
                                ->afterStateUpdated(fn ($state, Set $set) => $set('total_price', optional(Book::find($state))->price ?? 0)),
                            TextInput::make('quantity')
                                ->label('Jumlah')
                                ->numeric()
                                ->required()
                                ->default(1)
                                ->minValue(1)
                                ->columnSpan(2)
                                ->reactive()
                                ->afterStateUpdated(fn ($state, Set $set, Get $get) => $set('total_price', $state * $get('unit_price'))),
                            TextInput::make('unit_price')
                                ->label('Harga')
                                ->numeric()
                                ->required()
                                ->disabled()
                                ->dehydrated()
                                ->columnSpan(3),
                            TextInput::make('total_price')
                                ->label('Total harga')
                                ->numeric()
                                ->required()
                                ->disabled()
                                ->dehydrated()
                                ->columnSpan(3),
                            ])->columns(12),
                            Placeholder::make('grand_total_placeholder')
                                ->label('Grand total')
                                ->content(function (Get $get, Set $set){
                                    $total = 0;
                                    if (!$repeaters = $get('items')) {
                                        return $total;
                                    }

                                    foreach ($repeaters as $key => $repeater) {
                                        $total += $get("items.{$key}.total_price");
                                    }
                                    $set('grand_total', $total);
                                    return Number::currency($total, 'IDR');
                                }),
                                Hidden::make('grand_total')
                                    ->default(0)
                    ])
                ])->columnSpanFull()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('user.name')->label('Customers')->sortable()->searchable(),
                TextColumn::make('status')->badge()
                ->colors([
                    'info' => 'new',
                    'warning' => 'processing',
                    'info' => 'shipped',
                    'success' => 'delivered',
                    'danger' => 'cancelled',
                ])->icons([
                    'heroicon-o-sparkles' => 'new',
                    'heroicon-o-truck' => 'shipped',
                    'heroicon-o-arrow-path' => 'processing',
                    'heroicon-o-check-circle' => 'delivered',
                    'heroicon-o-x-circle' => 'cancelled'
                ])
                ->searchable()
                ->sortable(),
                TextColumn::make('payment_method')
                ->searchable()
                ->sortable(),
                TextColumn::make('payment_status')->badge()
                ->colors([
                    'warning' => 'pending',
                    'success' => 'paid',
                    'danger' => 'failed',
                ])->icons([
                    'heroicon-o-clock' => 'pending',
                    'heroicon-o-check-circle' => 'paid',
                    'heroicon-o-x-circle' => 'cancelled'
                ]),
                TextColumn::make('shipping_method')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('grand_total')->money('IDR')->sortable(),
                TextColumn::make('created_at')->dateTime()->sortable()->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')->dateTime()->sortable()->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\ViewAction::make(),
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\DeleteAction::make(),
                ])
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
            'index' => ListOrders::route('/'),
            'create' => Pages\CreateOrder::route('/create'),
            'edit' => Pages\EditOrder::route('/{record}/edit'),
        ];
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function getNavigationBadgeColor(): string|array|null
    {
        return static::getModel()::count() > 10 ? 'success' : 'danger';
    }

    public static function getWidgets(): array
    {
        return [
            OrderStats::class,
        ];
    }
}
