<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FonctionResource\Pages;
use App\Filament\Resources\FonctionResource\RelationManagers;
use App\Models\fonction;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class FonctionResource extends Resource
{
    protected static ?string $model = fonction::class;

    protected static ?int $navigationSort = 2;

    protected static ?string  $navigationGroup = 'Configuration';

    protected static ?string $navigationIcon = 'heroicon-o-bolt';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name'),

            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
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
            'index' => Pages\ListFonctions::route('/'),
            'create' => Pages\CreateFonction::route('/create'),
            'edit' => Pages\EditFonction::route('/{record}/edit'),
        ];
    }
}
