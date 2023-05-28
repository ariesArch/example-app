<?php

namespace App\Filament\Resources;

use Closure;
use Carbon\Carbon;
use Filament\Tables;
use Illuminate\Support\Str;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Filament\Resources\Resource;
use App\Models\CommunityCategory;
use Livewire\TemporaryUploadedFile;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\CommunityCategoryResource\Pages;

class CommunityCategoryResource extends Resource
{
    protected static ?string $model = CommunityCategory::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->required()
                    ->maxLength(255)
                    ->reactive()
                    ->afterStateUpdated(function (Closure $set, $state) {
                        $set('slug', Str::slug($state));
                    }),
                TextInput::make('slug')
                    ->required()
                    ->maxLength(255),
                FileUpload::make('image_url')->acceptedFileTypes(['image/jpeg', 'image/png'])
                    ->reactive()
                    ->disk('s3')
                    ->directory('community_category/image')
                    ->getUploadedFileNameForStorageUsing(function (TemporaryUploadedFile $file, callable $get): string {
                        // return (string) str($file->getClientOriginalName());
                        return (string) str(str_replace(' ', '-', $get('name')) . '.' . $file->getClientOriginalExtension());
                    })
                    ->afterStateUpdated(function (Closure $set) {
                        $set('image_uploaded_at', Carbon::now()->format('Y-m-d H:i:s'));
                    }),
                TextInput::make('image_uploaded_at'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name'),
                TextColumn::make('slug'),
                TextColumn::make('image_name'),
                TextColumn::make('image_type'),
                TextColumn::make('image_size'),
                TextColumn::make('image_url'),
                TextColumn::make('image_uploaded_at')
                    ->dateTime(),
                TextColumn::make('created_at')
                    ->dateTime(),
                TextColumn::make('updated_at')
                    ->dateTime(),
                TextColumn::make('deleted_at')
                    ->dateTime(),
            ])
            ->filters([
                Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
                Tables\Actions\ForceDeleteBulkAction::make(),
                Tables\Actions\RestoreBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCommunityCategories::route('/'),
            'create' => Pages\CreateCommunityCategory::route('/create'),
            'edit' => Pages\EditCommunityCategory::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
