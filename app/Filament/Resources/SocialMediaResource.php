<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SocialMediaResource\Pages;
use App\Models\SocialMedia;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Database\Eloquent\Collection;

class SocialMediaResource extends Resource
{
    protected static ?string $model = SocialMedia::class;

    protected static ?string $navigationIcon = 'heroicon-o-share';
    protected static ?string $navigationLabel = 'Social Media';
    protected static ?string $navigationGroup = 'Website Settings';
    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Social Media Details')
                    ->schema([
                        Forms\Components\Select::make('platform')
                            ->label('Platform')
                            ->options(SocialMedia::getPlatformOptions())
                            ->default(SocialMedia::PLATFORM_OTHER)
                            ->reactive()
                            ->afterStateUpdated(function ($set, $state) {
                                // Set default icon based on platform
                                $icons = [
                                    SocialMedia::PLATFORM_FACEBOOK => 'fab fa-facebook-f',
                                    SocialMedia::PLATFORM_TWITTER => 'fab fa-twitter',
                                    SocialMedia::PLATFORM_INSTAGRAM => 'fab fa-instagram',
                                    SocialMedia::PLATFORM_YOUTUBE => 'fab fa-youtube',
                                    SocialMedia::PLATFORM_LINKEDIN => 'fab fa-linkedin-in',
                                    SocialMedia::PLATFORM_TIKTOK => 'fab fa-tiktok',
                                    SocialMedia::PLATFORM_WHATSAPP => 'fab fa-whatsapp',
                                    SocialMedia::PLATFORM_TELEGRAM => 'fab fa-telegram',
                                ];

                                if (array_key_exists($state, $icons)) {
                                    $set('icon', $icons[$state]);
                                }

                                // Set placeholder for URL based on platform
                                $urlPlaceholders = [
                                    SocialMedia::PLATFORM_FACEBOOK => 'https://facebook.com/yourusername',
                                    SocialMedia::PLATFORM_TWITTER => 'https://twitter.com/yourusername',
                                    SocialMedia::PLATFORM_INSTAGRAM => 'https://instagram.com/yourusername',
                                    SocialMedia::PLATFORM_YOUTUBE => 'https://youtube.com/@yourchannel',
                                    SocialMedia::PLATFORM_LINKEDIN => 'https://linkedin.com/in/yourusername',
                                    SocialMedia::PLATFORM_TIKTOK => 'https://tiktok.com/@yourusername',
                                    SocialMedia::PLATFORM_WHATSAPP => 'https://wa.me/62812345678',
                                    SocialMedia::PLATFORM_TELEGRAM => 'https://t.me/yourusername',
                                ];

                                if (array_key_exists($state, $urlPlaceholders)) {
                                    $set('name', SocialMedia::getPlatformOptions()[$state]);
                                }
                            }),

                        Forms\Components\TextInput::make('name')
                            ->label('Display Name')
                            ->required()
                            ->maxLength(255),

                        Forms\Components\TextInput::make('url')
                            ->label('URL')
                            ->required()
                            ->url()
                            ->maxLength(255)
                            ->helperText('For WhatsApp, use format: https://wa.me/628xxxxxxxxxx (include country code)'),

                        Forms\Components\TextInput::make('icon')
                            ->label('Icon Class (FontAwesome)')
                            ->placeholder('fab fa-facebook')
                            ->helperText('Enter FontAwesome or other icon class')
                            ->maxLength(100),

                        Forms\Components\Toggle::make('is_active')
                            ->label('Active')
                            ->default(true),

                        Forms\Components\TextInput::make('sort_order')
                            ->label('Sort Order')
                            ->numeric()
                            ->default(0)
                            ->helperText('Lower numbers appear first'),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('platform')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('url')
                    ->searchable()
                    ->url(fn(SocialMedia $record): string => $record->url)
                    ->openUrlInNewTab()
                    ->limit(30),

                Tables\Columns\TextColumn::make('icon')
                    ->formatStateUsing(fn($state) => "<i class='{$state}'></i> {$state}")
                    ->html(),

                Tables\Columns\IconColumn::make('is_active')
                    ->boolean()
                    ->label('Active')
                    ->sortable(),

                Tables\Columns\TextColumn::make('sort_order')
                    ->sortable(),

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
                Tables\Filters\SelectFilter::make('platform')
                    ->options(SocialMedia::getPlatformOptions()),
                Tables\Filters\TernaryFilter::make('is_active')
                    ->label('Active Status')
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\BulkAction::make('toggleActive')
                        ->label('Toggle Active Status')
                        ->icon('heroicon-o-check-circle')
                        ->action(function (Collection $records): void {
                            $records->each(function ($record): void {
                                $record->is_active = !$record->is_active;
                                $record->save();
                            });
                        }),
                ]),
            ])
            ->defaultSort('sort_order');
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
            'index' => Pages\ListSocialMedia::route('/'),
            'create' => Pages\CreateSocialMedia::route('/create'),
            'edit' => Pages\EditSocialMedia::route('/{record}/edit'),
        ];
    }
}
