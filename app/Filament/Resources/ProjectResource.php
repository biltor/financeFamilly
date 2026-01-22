<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProjectResource\Pages;
use App\Filament\Resources\ProjectResource\RelationManagers;
use App\Models\project;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ProjectResource extends Resource
{
    protected static ?string $model = project::class;
    protected static ?string  $navigationGroup = 'Projet';

    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document';
    protected static ?string $navigationLabel = 'Projets';
    protected static ?string $pluralModelLabel = 'creation Projets';
    protected static ?string $modelLabel = 'Projet';
    protected static ?int $navigationSort = 10;



    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->label('Titre')
                    ->required()
                    ->maxLength(255),

                Forms\Components\TextInput::make('montant_total')
                    ->label('Montant Devis')
                    ->numeric()
                    ->default(0),

                Forms\Components\Select::make('statut')
                    ->label('Statut')
                    ->options([
                        'en_cours' => 'En cours',
                        'terminé' => 'Terminé',
                        'annulé' => 'Annulé',
                    ])
                    ->default('en_cours')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                                Tables\Columns\TextColumn::make('title')
                    ->label('Titre')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('montant_total')
                    ->label('Montant total')
                    ->money('DZD')
                    ->sortable(),

                Tables\Columns\BadgeColumn::make('statut')
                    ->label('Statut')
                    ->colors([
                        'warning' => 'en_cours',
                        'success' => 'terminé',
                        'danger' => 'annulé',
                    ]),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Créé le')
                    ->date()
                    ->sortable(),
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
            'index' => Pages\ListProjects::route('/'),
            'create' => Pages\CreateProject::route('/create'),
            'edit' => Pages\EditProject::route('/{record}/edit'),
        ];
    }
}
