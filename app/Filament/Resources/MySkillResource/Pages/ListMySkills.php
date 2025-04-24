<?php

namespace App\Filament\Resources\MySkillResource\Pages;

use App\Filament\Resources\MySkillResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListMySkills extends ListRecords
{
    protected static string $resource = MySkillResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
