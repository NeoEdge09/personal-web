<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SiteSettingResource\Pages;
use App\Models\SiteSetting;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class SiteSettingResource extends Resource
{
    protected static ?string $model = SiteSetting::class;

    protected static ?string $navigationIcon = 'heroicon-o-cog';

    protected static ?string $navigationLabel = 'Site Settings';
    protected static ?string $navigationGroup = 'Website Settings';

    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('General Settings')
                    ->schema([
                        Forms\Components\TextInput::make('site_name')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\FileUpload::make('favicon')
                            ->image()
                            ->directory('site-settings')
                            ->visibility('public')
                            ->imagePreviewHeight('150')
                            ->maxSize(1024)
                            ->nullable(),
                        Forms\Components\FileUpload::make('logo')
                            ->image()
                            ->directory('site-settings')
                            ->visibility('public')
                            ->imagePreviewHeight('150')
                            ->maxSize(1024)
                            ->nullable(),
                        Forms\Components\Textarea::make('description')
                            ->rows(4)
                            ->nullable()
                            ->maxLength(1000),
                    ])
                    ->columns(1),

                Forms\Components\Section::make('Color Settings')
                    ->schema([
                        Forms\Components\Grid::make(2)
                            ->schema([
                                Forms\Components\Section::make('Light Mode Colors')
                                    ->schema([
                                        Forms\Components\ColorPicker::make('primary_color')
                                            ->label('Primary Color')
                                            ->default('#adff00')
                                            ->helperText('Used for buttons, links, and highlighted elements'),

                                        Forms\Components\ColorPicker::make('secondary_color')
                                            ->label('Secondary Color')
                                            ->default('#8acc00')
                                            ->helperText('Used for hover states and secondary elements'),

                                        Forms\Components\ColorPicker::make('text_color')
                                            ->label('Text Color')
                                            ->default('#615978')
                                            ->helperText('Main text color'),

                                        Forms\Components\ColorPicker::make('heading_color')
                                            ->label('Heading Color')
                                            ->default('#222')
                                            ->helperText('Used for headings (h1-h6)'),

                                        Forms\Components\ColorPicker::make('background_color')
                                            ->label('Background Color')
                                            ->default('#aab6c2')
                                            ->helperText('Main background color'),
                                    ])
                                    ->columns(1),

                                Forms\Components\Section::make('Dark Mode Colors')
                                    ->schema([
                                        Forms\Components\ColorPicker::make('dark_mode_primary_color')
                                            ->label('Dark Mode Primary Color')
                                            ->default('#adff00')
                                            ->helperText('Primary color in dark mode'),

                                        Forms\Components\ColorPicker::make('dark_mode_background_color')
                                            ->label('Dark Mode Background Color')
                                            ->default('#31333c')
                                            ->helperText('Background color in dark mode'),
                                    ])
                                    ->columns(1),
                            ]),
                    ])
                    ->collapsible(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('site_name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\ImageColumn::make('logo')
                    ->circular(),
                Tables\Columns\ColorColumn::make('primary_color')
                    ->label('Primary Color'),
                Tables\Columns\ColorColumn::make('dark_mode_background_color')
                    ->label('Dark Background'),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
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
            'index' => Pages\ListSiteSettings::route('/'),
            'create' => Pages\CreateSiteSetting::route('/create'),
            'edit' => Pages\EditSiteSetting::route('/{record}/edit'),
        ];
    }
}
