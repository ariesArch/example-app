<?php

namespace App\Filament\Resources\PageResource\Pages;

use App\Filament\Resources\PageResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;

class CreatePage extends CreateRecord
{
    protected static string $resource = PageResource::class;
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
    // protected function handleRecordCreation(array $data): Model
    // {
    //     $record =  static::getModel()::create($data);
    //     $record->profile()->create($data['profile']);

    //     return $record;
    // }
    public function fields()
    {
        return [
            // other fields...
            Components\BelongsToSelect::make('profile')
                ->relationship('profilable', Profile::class)
                ->label('Profile')
                ->optionsLabel('full_name')
                ->placeholder('Select a profile')
                ->belongsToNested('city', 'App\Filament\Resources\CityResource', 'city')
                ->belongsToNested('township', 'App\Filament\Resources\TownshipResource', 'township'),
        ];
    }
}
