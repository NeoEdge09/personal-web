<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PortfolioResource\Pages;
use App\Models\Portfolio;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class PortfolioResource extends Resource
{
    protected static ?string $model = Portfolio::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Content';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Basic Information')
                    ->schema([
                        Forms\Components\TextInput::make('title')
                            ->required()
                            ->maxLength(255)
                            ->live(onBlur: true)
                            ->afterStateUpdated(fn(string $operation, $state, Forms\Set $set) =>
                            $operation === 'create' ? $set('slug', Str::slug($state)) : null),

                        Forms\Components\TextInput::make('slug')
                            ->required()
                            ->maxLength(255)
                            ->unique(ignoreRecord: true),

                        Forms\Components\Select::make('category')
                            // ->options([
                            //     'web-development' => 'Web Development',
                            //     'mobile-app' => 'Mobile App',
                            //     'design' => 'Design',
                            //     'other' => 'Other',
                            // ])

                            ->options([
                                'media-relations' => 'Media Relations',
                                'event-management' => 'Event Management',
                                'content-creation' => 'Content Creation',
                                'social-media' => 'Social Media',
                                'branding' => 'Branding',
                                'csr' => 'CSR',
                                'public-speaking-&-mc' => 'Public Speaking & MC',
                                'other' => 'Other',
                            ])
                            ->required(),

                        Forms\Components\Select::make('status')
                            ->options([
                                'draft' => 'Draft',
                                'published' => 'Published',
                            ])
                            ->default('draft')
                            ->required(),

                        Forms\Components\FileUpload::make('featured_image')
                            ->image()
                            ->required(),
                    ]),

                Forms\Components\Section::make('Description')
                    ->schema([
                        Forms\Components\RichEditor::make('description')
                            ->required()
                            ->fileAttachmentsDisk('public')
                    ]),

                Forms\Components\Section::make('Gallery')
                    ->schema([
                        Forms\Components\FileUpload::make('gallery')
                            ->multiple()
                            ->image()
                            ->reorderable(),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('featured_image')
                    ->square(),

                Tables\Columns\TextColumn::make('title')
                    ->searchable(),

                Tables\Columns\TextColumn::make('category')
                    ->badge()
                    ->formatStateUsing(fn(string $state): string => ucwords(str_replace('-', ' ', $state)))
                    ->colors([
                        'primary' => 'web-development',
                        'success' => 'mobile-app',
                        'warning' => 'design',
                        'danger' => 'other',
                    ]),

                Tables\Columns\BadgeColumn::make('status')
                    ->colors([
                        'danger' => 'draft',
                        'success' => 'published',
                    ]),

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
                Tables\Filters\SelectFilter::make('category')
                    ->options([
                        'web-development' => 'Web Development',
                        'mobile-app' => 'Mobile App',
                        'design' => 'Design',
                        'other' => 'Other',
                    ]),

                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        'draft' => 'Draft',
                        'published' => 'Published',
                    ]),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
                Tables\Actions\Action::make('publish')
                    ->label('Publish')
                    ->icon('heroicon-o-check')
                    ->color('success')
                    ->visible(fn(Portfolio $record) => $record->status === 'draft')
                    ->action(fn(Portfolio $record) => $record->update(['status' => 'published'])),

                Tables\Actions\Action::make('unpublish')
                    ->label('Unpublish')
                    ->icon('heroicon-o-x-mark')
                    ->color('danger')
                    ->visible(fn(Portfolio $record) => $record->status === 'published')
                    ->action(fn(Portfolio $record) => $record->update(['status' => 'draft'])),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\BulkAction::make('publish')
                        ->label('Publish Selected')
                        ->icon('heroicon-o-check')
                        ->color('success')
                        ->action(fn($records) => $records->each->update(['status' => 'published'])),

                    Tables\Actions\BulkAction::make('unpublish')
                        ->label('Unpublish Selected')
                        ->icon('heroicon-o-x-mark')
                        ->color('danger')
                        ->action(fn($records) => $records->each->update(['status' => 'draft'])),
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
            'index' => Pages\ListPortfolios::route('/'),
            'create' => Pages\CreatePortfolio::route('/create'),
            'edit' => Pages\EditPortfolio::route('/{record}/edit'),
        ];
    }
}
