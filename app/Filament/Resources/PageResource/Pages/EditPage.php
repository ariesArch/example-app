<?php

namespace App\Filament\Resources\PageResource\Pages;

use App\Filament\Resources\PageResource;
use App\Models\Page;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPage extends EditRecord
{
    protected static string $resource = PageResource::class;
    public $context;
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
    public function beforeFill(): void
    {
        // $this->record->load('profile');
        // \Log::info(print_r($record, true));
        // return $record;
        // parent::beforeFill($record);
        // $this->context->record($record);
        // $this->record->makeVisible(['profile']);
    }
}
