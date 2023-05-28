<?php

namespace App\Filament\Resources\PageResource\RelationManagers;

use Filament\Forms;
use Filament\Tables;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Resources\RelationManagers\RelationManager;

class ProfileRelationManager extends RelationManager
{
    protected static string $relationship = 'profile';

    protected static ?string $recordTitleAttribute = 'phone_no';
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('phone_no')
                    ->required()
                    ->maxLength(255),
                Select::make('city_id')
                    ->relationship('city', 'name')
                    ->searchable()
                    ->required(),
                Select::make('township_id')
                    ->relationship('township', 'name', fn (Builder $query, callable $get) => $query->where('city_id', $get('city_id')))
                    ->searchable()
                    ->required(),
                Section::make('Address')
                    ->statePath('address')
                    ->schema([
                        TextInput::make('Quarter'),
                        TextInput::make('Street'),
                        TextInput::make('Address'),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('city.name'),
                Tables\Columns\TextColumn::make('township.name'),
                Tables\Columns\TextColumn::make('phone_no'),
                Tables\Columns\TextColumn::make('address'),
            ])
            ->filters([
                Tables\Filters\TrashedFilter::make()
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()->hidden(
                    function (RelationManager $livewire) {
                        \Log::info($livewire->ownerRecord->profile);
                        return $livewire->ownerRecord->profile;
                    }
                )
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
                Tables\Actions\ForceDeleteAction::make(),
                Tables\Actions\RestoreAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
                Tables\Actions\RestoreBulkAction::make(),
                Tables\Actions\ForceDeleteBulkAction::make(),
            ]);
    }

    protected function getTableQuery(): Builder
    {
        return parent::getTableQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
