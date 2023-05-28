<?php

namespace App\Filament\Resources\TownshipResource\Pages;

use App\Filament\Resources\TownshipResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTownship extends EditRecord
{
    protected static string $resource = TownshipResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
            Actions\ForceDeleteAction::make(),
            Actions\RestoreAction::make(),
        ];
    }
}
