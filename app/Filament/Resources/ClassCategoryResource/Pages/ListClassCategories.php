<?php

namespace App\Filament\Resources\ClassCategoryResource\Pages;

use App\Filament\Resources\ClassCategoryResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListClassCategories extends ListRecords
{
    protected static string $resource = ClassCategoryResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
