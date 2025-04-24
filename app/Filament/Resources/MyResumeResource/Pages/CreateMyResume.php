<?php

namespace App\Filament\Resources\MyResumeResource\Pages;

use App\Filament\Resources\MyResumeResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateMyResume extends CreateRecord
{
    protected static string $resource = MyResumeResource::class;
}
