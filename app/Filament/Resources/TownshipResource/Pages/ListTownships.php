<?php

namespace App\Filament\Resources\TownshipResource\Pages;

use App\Filament\Resources\TownshipResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTownships extends ListRecords
{
    protected static string $resource = TownshipResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
