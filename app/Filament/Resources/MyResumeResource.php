<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MyResumeResource\Pages;
use App\Models\MyResume;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class MyResumeResource extends Resource
{
    protected static ?string $model = MyResume::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static ?string $navigationGroup = 'Resume';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Tabs::make('Resume')
                    ->tabs([
                        Forms\Components\Tabs\Tab::make('Education')
                            ->schema([
                                Forms\Components\Repeater::make('education')
                                    ->schema([
                                        Forms\Components\TextInput::make('title')
                                            ->required()
                                            ->label('Degree/Certification Title'),

                                        Forms\Components\TextInput::make('school')
                                            ->required()
                                            ->label('School/College'),

                                        Forms\Components\Textarea::make('desc')
                                            ->required()
                                            ->label('Description')
                                            ->columnSpanFull(),

                                        Forms\Components\TextInput::make('year')
                                            ->required()
                                            ->label('Year Range/Present')
                                            ->placeholder('e.g., 2018-2022 or 2020-Present'),
                                    ])
                                    ->defaultItems(1)
                                    ->columns(2)
                            ]),

                        Forms\Components\Tabs\Tab::make('Experience')
                            ->schema([
                                Forms\Components\Repeater::make('experience')
                                    ->schema([
                                        Forms\Components\TextInput::make('title')
                                            ->required()
                                            ->label('Job Title'),

                                        Forms\Components\TextInput::make('company')
                                            ->required()
                                            ->label('Company Name'),

                                        Forms\Components\Textarea::make('desc')
                                            ->required()
                                            ->label('Job Description')
                                            ->columnSpanFull(),

                                        Forms\Components\TextInput::make('year')
                                            ->required()
                                            ->label('Year Range/Present')
                                            ->placeholder('e.g., 2018-2022 or 2020-Present'),
                                    ])
                                    ->defaultItems(1)
                                    ->columns(2)
                            ]),
                    ])
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label('Resume ID'),

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
            'index' => Pages\ListMyResumes::route('/'),
            'create' => Pages\CreateMyResume::route('/create'),
            'edit' => Pages\EditMyResume::route('/{record}/edit'),
        ];
    }
}
