<?php

namespace App\Filament\Resources\ClassCategoryResource\Pages;

use App\Filament\Resources\ClassCategoryResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditClassCategory extends EditRecord
{
    protected static string $resource = ClassCategoryResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
            Actions\ForceDeleteAction::make(),
            Actions\RestoreAction::make(),
        ];
    }
}
