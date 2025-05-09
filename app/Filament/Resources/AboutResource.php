<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AboutResource\Pages;
use App\Models\About;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class AboutResource extends Resource
{
    protected static ?string $model = About::class;

    protected static ?string $navigationIcon = 'heroicon-o-user';

    protected static ?string $navigationGroup = 'Content';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Basic Information')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('base')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('main_title')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\Textarea::make('desc')
                            ->label('Description')
                            ->rows(3)
                            ->maxLength(1000),
                        Forms\Components\FileUpload::make('image')
                            ->image()
                            ->required(),
                        Forms\Components\FileUpload::make('image_2')
                            ->image()
                            ->nullable(),
                        Forms\Components\FileUpload::make('cv')
                            ->acceptedFileTypes(['application/pdf'])
                            ->nullable(),
                    ])
                    ->columns(2)
                    ->collapsible(),

                Forms\Components\Section::make('Typed Titles')
                    ->schema([
                        Forms\Components\Repeater::make('title')
                            ->schema([
                                Forms\Components\TextInput::make('value')
                                    ->required()
                                    ->label('Title')
                                    ->maxLength(255),
                            ])
                            ->columns(1)
                            ->defaultItems(2)
                    ])
                    ->collapsible(),
                Forms\Components\Section::make('Contact Information')
                    ->schema([
                        Forms\Components\TextInput::make('email')
                            ->email()
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('phone')
                            ->tel()
                            ->required()
                            ->maxLength(255),
                        Forms\Components\Textarea::make('address')
                            ->required()
                            ->rows(3),
                        Forms\Components\DatePicker::make('birth_date')
                            ->required(),
                        Forms\Components\TextInput::make('education')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\Select::make('freelance_status')
                            ->options([
                                'available' => 'Available',
                                'unavailable' => 'Unavailable',
                            ])
                            ->required(),
                    ])
                    ->columns(2)
                    ->collapsible(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\ImageColumn::make('image'),
                Tables\Columns\TextColumn::make('email')
                    ->searchable(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListAbouts::route('/'),
            'create' => Pages\CreateAbout::route('/create'),
            'edit' => Pages\EditAbout::route('/{record}/edit'),
        ];
    }
}
