<?php

namespace App\Filament\Resources\Products\Schemas;

use Filament\Schemas\Schema;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;

class ProductForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(3)
            ->components([
                Group::make()
                    ->columnSpan(2)
                    ->schema([
                        Section::make('Product Details')
                            ->schema([
                                TextInput::make('nama')
                                    ->required()
                                    ->maxLength(255),
                                    
                                Select::make('category_id')
                                    ->relationship('category', 'name')
                                    ->required()
                                    ->searchable()
                                    ->preload(),
                                    
                                TextInput::make('harga')
                                    ->required()
                                    ->numeric()
                                    ->prefix('IDR'),
                                    
                                TextInput::make('stok')
                                    ->required()
                                    ->numeric()
                                    ->default(0),

                                Textarea::make('deskripsi')
                                    ->rows(5)
                                    ->columnSpanFull(),
                            ])->columns(2),
                    ]),

                Group::make()
                    ->columnSpan(1)
                    ->schema([
                        Section::make('Product Image')
                            ->schema([
                                FileUpload::make('image')
                                    ->image()
                                    ->disk('public')
                                    ->directory('products')
                                    ->visibility('public')
                                    ->columnSpanFull(),
                            ]),
                    ]),
            ]);
    }
}