<?php

namespace App\Filament\Resources\ContactMessageResource\Pages;

use App\Filament\Resources\ContactMessageResource;
use App\Models\ContactMessage;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewContactMessage extends ViewRecord
{
    protected static string $resource = ContactMessageResource::class;

    protected function afterFill(): void
    {
        if ($this->record->status === ContactMessage::STATUS_UNREAD) {
            $this->record->status = ContactMessage::STATUS_READ;
            $this->record->save();
        }
    }
}
