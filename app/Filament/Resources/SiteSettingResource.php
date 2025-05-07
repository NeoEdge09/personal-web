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

                Forms\Components\Section::make('Theme Selection')
                    ->schema([
                        Forms\Components\Hidden::make('themes'),

                        Forms\Components\Select::make('selected_theme')
                            ->label('Choose Website Theme')
                            ->options(function () {
                                $model = new SiteSetting();
                                $templates = $model->getThemeTemplates();
                                return collect($templates)->pluck('name', 'name')->toArray();
                            })
                            ->default('Modern Purple')
                            ->required()
                            ->reactive()
                            ->afterStateUpdated(function (string $state, callable $set) {
                                // Get theme templates
                                $model = new SiteSetting();
                                $templates = $model->getThemeTemplates();
                                $selectedTemplate = collect($templates)->firstWhere('name', $state);

                                if ($selectedTemplate) {
                                    $selectedTemplate['is_active'] = true;
                                    // Set the themes field directly as an array with only the selected theme
                                    $set('themes', [$selectedTemplate]);
                                }
                            })
                            ->dehydrated(false), // This field won't be submitted to the database directly

                        Forms\Components\View::make('filament.forms.components.theme-preview')
                            ->visible(fn($get) => !empty($get('selected_theme')))
                    ])
                    ->columns(1)
                    ->collapsible(),
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
