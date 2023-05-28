<?php

namespace App\Filament\Resources\CommunityCategoryResource\Pages;

use App\Filament\Resources\CommunityCategoryResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCommunityCategory extends EditRecord
{
    protected static string $resource = CommunityCategoryResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
            Actions\ForceDeleteAction::make(),
            Actions\RestoreAction::make(),
        ];
    }
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
