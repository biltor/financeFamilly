<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ReglementResource\Pages;
use App\Filament\Resources\ReglementResource\RelationManagers;
use App\Models\reglement;
use App\Models\Client;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ReglementResource extends Resource
{
    protected static ?string $model = reglement::class;

    protected static ?string $navigationIcon = 'heroicon-o-banknotes';
    protected static ?string $navigationGroup = 'Projet';
    protected static ?string $label = 'Reglement';
    protected static ?string $pluralLabel = 'Reglements';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informations générales')
                    ->schema([
                        Forms\Components\Select::make('project_id')
                            ->relationship('project', 'title')
                            ->label('Projet')
                            ->searchable()
                            ->required(),


                        Forms\Components\Select::make('client_id')
                            ->label('Client')
                            ->options(
                                fn() =>
                                Client::nonFamille()
                                    ->orderBy('name')
                                    ->pluck('name', 'id')
                            )
                            ->reactive()
                            ->preload()
                            ->required(),

                        Forms\Components\Select::make('caisse_id')
                            ->options(function ($get) {
                                $clientId = $get('client_id');
                                if (!$clientId) return []; // aucun client choisi
                                return \App\Models\Caisse::where('client_id', $clientId)
                                    ->pluck('title', 'id');
                            })
                            ->required(),
                    ])->columns(3),

                Forms\Components\Section::make('Détails financiers')
                    ->schema([
                        Forms\Components\TextInput::make('montant')
                            ->label('Montant')
                            ->numeric()
                            ->required(),

                        Forms\Components\DatePicker::make('date_reglement')
                            ->label('Date de règlement')
                            ->default(now())
                            ->required(),
                    ])->columns(3),

                Forms\Components\Textarea::make('description')
                    ->label('Description')
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('project.title')
                    ->label('Projet')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('client.name')
                    ->label('Client')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('caisse.title')
                    ->label('Caisse')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('montant')
                    ->label('Montant')
                    ->money('DZD', true) // adapte si multi-devise
                    ->sortable(),

                Tables\Columns\TextColumn::make('date_reglement')
                    ->label('Date')
                    ->date('d/m/Y')
                    ->sortable(),

                Tables\Columns\TextColumn::make('description')
                    ->label('Description')
                    ->limit(40)
                    ->toggleable(isToggledHiddenByDefault: true),
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
            'index' => Pages\ListReglements::route('/'),
            'create' => Pages\CreateReglement::route('/create'),
            'edit' => Pages\EditReglement::route('/{record}/edit'),
        ];
    }
}
