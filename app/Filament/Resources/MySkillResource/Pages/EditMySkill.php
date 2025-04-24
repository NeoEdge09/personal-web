<?php

namespace App\Filament\Resources\MySkillResource\Pages;

use App\Filament\Resources\MySkillResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditMySkill extends EditRecord
{
    protected static string $resource = MySkillResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
