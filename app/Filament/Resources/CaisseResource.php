<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CaisseResource\Pages;
use App\Filament\Resources\CaisseResource\RelationManagers;
use App\Models\Caisse;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CaisseResource extends Resource
{
    protected static ?string $model = Caisse::class;


    protected static ?string  $navigationGroup = 'Comptabilité';

    protected static ?string $navigationIcon = 'heroicon-o-ticket';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Select::make('client_id')
                    ->relationship('client', 'name')
                    ->required(),
                Forms\Components\TextInput::make('init_solde')
                    ->label('solde initial')
                    ->required()
                    ->numeric(),
                Forms\Components\Select::make('Type')
                    ->options([
                        'EUR' => 'EUR',
                        'DZD' => 'DZD',
                    ])
                    ->default('DZD')
                    ->required()
                    ->label('Account Type'),
                Forms\Components\Toggle::make('Active')


            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title'),
                Tables\Columns\TextColumn::make('client.name'),
                Tables\Columns\TextColumn::make('init_solde')->label('solde initial'),
                Tables\Columns\TextColumn::make('Type'),
                Tables\Columns\TextColumn::make('Active'),
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
            'index' => Pages\ListCaisses::route('/'),
            'create' => Pages\CreateCaisse::route('/create'),
            'edit' => Pages\EditCaisse::route('/{record}/edit'),
        ];
    }
}
