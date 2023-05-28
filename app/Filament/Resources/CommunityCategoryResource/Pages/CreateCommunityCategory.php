<?php

namespace App\Filament\Resources\CommunityCategoryResource\Pages;

use App\Filament\Resources\CommunityCategoryResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateCommunityCategory extends CreateRecord
{
    protected static string $resource = CommunityCategoryResource::class;
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
