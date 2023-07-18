<?php

namespace App\Filament\Resources\PageResource\RelationManagers;

use App\Models\Community;
use Filament\Forms;
use Filament\Tables;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Filament\Forms\Components\Select;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Resources\RelationManagers\RelationManager;

class SocietyRelationManager extends RelationManager
{
    protected static string $relationship = 'society';

    protected static ?string $recordTitleAttribute = 'community_id';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('community_id')
                    // ->relationship('community', 'name', function (Builder $query, RelationManager $livewire) {
                    //     // $query->where('community_category_id', $livewire->ownerRecord->community_category_id)->where('id', '<>', $livewire->ownerRecord->community_id);
                    //     $pageId = $livewire->ownerRecord->id; // get the ID of the parent Page model
                    //     $communityCategoryId = $livewire->ownerRecord->community_category_id; // get the community category ID
                    //     // Add a where condition to exclude the communities with page_id=1
                    //     $query->where('community_category_id', $communityCategoryId)
                    //         ->where('id', '<>', $livewire->ownerRecord->community_id)
                    //         ->whereNotIn('id', function ($query) use ($pageId) {
                    //             $query->select('community_id')
                    //                 ->from('societies')
                    //                 ->where('sociable_type', 'App\Models\Page')
                    //                 ->where('sociable_id', $pageId)
                    //                 ->distinct();
                    //         });
                    // })
                    ->options(function (RelationManager $livewire) {
                        $pageId = $livewire->ownerRecord->id; // get the ID of the parent Page model
                        $communityCategoryId = $livewire->ownerRecord->community_category_id; // get the community category ID
                        // Add a where condition to exclude the communities with page_id=1
                        return Community::where('community_category_id', $communityCategoryId)
                            ->where('id', '<>', $livewire->ownerRecord->community_id)
                            ->whereNotIn('id', function ($query) use ($pageId) {
                                $query->select('community_id')
                                    ->from('societies')
                                    ->where('sociable_type', 'App\Models\Page')
                                    ->where('sociable_id', $pageId)
                                    ->distinct();
                            })
                            ->get()->pluck(value: 'name', key: 'id')->toArray();
                    })
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('community.name'),
            ])
            ->filters([
                Tables\Filters\TrashedFilter::make()
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()->hidden(
                    function (RelationManager $livewire) {
                        \Log::info($livewire->ownerRecord->society);
                        return $livewire->ownerRecord->society->count() > 1;
                    }
                ),
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
