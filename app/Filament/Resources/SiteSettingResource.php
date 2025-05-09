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
                            ->visibility('public')
                            ->imagePreviewHeight('150')
                            ->maxSize(1024)
                            ->nullable(),
                        Forms\Components\FileUpload::make('logo')
                            ->image()
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
                Forms\Components\Section::make('Theme Settings')
                    ->schema([
                        Forms\Components\Select::make('active_theme')
                            ->label('Choose Website Theme')
                            ->options(function () {
                                $model = new SiteSetting();
                                $templates = $model->getThemeTemplates();
                                return collect($templates)->pluck('name', 'name')->toArray();
                            })
                            ->default(function (?SiteSetting $record) {
                                if (!$record) return null;
                                return $record->activeTheme['name'] ?? null;
                            })
                            ->required()
                            ->reactive()
                            ->afterStateUpdated(function (string $state, callable $set) {
                                $model = new SiteSetting();
                                $templates = $model->getThemeTemplates();

                                // Create a new array of templates with the selected one marked active
                                $updatedTemplates = collect($templates)->map(function ($template) use ($state) {
                                    $template['is_active'] = ($template['name'] === $state);
                                    return $template;
                                })->toArray();

                                // Set the full theme configuration
                                $set('themes', $updatedTemplates);
                            }),
                        \Filament\Forms\Components\ViewField::make('theme_preview')
                            ->view('filament.forms.components.color-palette-preview')
                            ->label('Theme Colors Preview')
                            ->statePath('themes')
                            ->columnSpanFull(),
                    ])
                    ->columns(1),
            ])
            ->statePath('data');
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
                Tables\Columns\ViewColumn::make('themes')
                    ->label('Active Theme')
                    ->view('filament.tables.columns.active-theme'),
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
