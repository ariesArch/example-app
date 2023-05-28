<?php

namespace App\Filament\Resources\CommunityCategoryResource\Pages;

use App\Filament\Resources\CommunityCategoryResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCommunityCategories extends ListRecords
{
    protected static string $resource = CommunityCategoryResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
