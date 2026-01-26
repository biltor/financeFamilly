<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MouvementCaisseResource\Pages;
use App\Filament\Resources\MouvementCaisseResource\RelationManagers;
use App\Models\mouvement_caisse;
use App\Models\MouvementCaisse;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class MouvementCaisseResource extends Resource
{
    protected static ?string $model = mouvement_caisse::class;

    protected static ?string $navigationLabel = 'Mouvements de caisse';
    protected static ?string  $navigationGroup = 'Comptabilité';
    protected static ?string $navigationIcon = 'heroicon-o-arrows-right-left';
    protected static ?int $navigationSort = 30;

    // 🔒 Lecture seule recommandée
    public static function canCreate(): bool
    {
        return false;
    }

    public static function canEdit($record): bool
    {
        return false;
    }

    public static function canDelete($record): bool
    {
        return false;
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('caisse_id')
                    ->relationship('caisse', 'title')
                    ->disabled(),

                Forms\Components\TextInput::make('type')
                    ->disabled(),

                Forms\Components\TextInput::make('montant')
                    ->numeric()
                    ->disabled(),

                Forms\Components\TextInput::make('devise')
                    ->disabled(),

                Forms\Components\Textarea::make('description')
                    ->disabled()
                    ->columnSpanFull(),

                Forms\Components\Select::make('exchange_id')
                    ->relationship('exchange', 'id')
                    ->label('Échange')
                    ->disabled(),

                Forms\Components\DatePicker::make('date_mouv')
                    ->label('Date du mouvement')
                    ->disabled(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('date_mouv')
                    ->label('Date')
                    ->date()
                    ->sortable(),

                Tables\Columns\TextColumn::make('caisse.title')
                    ->label('Caisse')
                    ->searchable(),

                Tables\Columns\TextColumn::make('type')
                    ->label('Sens')
                    ->badge()
                    ->color(
                        fn(string $state) =>
                        $state === 'credit' ? 'success' : 'danger'
                    ),

                Tables\Columns\TextColumn::make('montant')
                    ->numeric()
                    ->label('Montant'),

                Tables\Columns\TextColumn::make('devise')
                    ->badge(),

                Tables\Columns\TextColumn::make('description')
                    ->limit(40)
                    ->wrap(),

                Tables\Columns\TextColumn::make('exchange_id')
                    ->label('Échange')
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('type')
                    ->options([
                        'credit' => 'Crédit',
                        'debit'  => 'Débit',
                    ]),

                Tables\Filters\SelectFilter::make('caisse')
                    ->relationship('caisse', 'title'),

                Tables\Filters\SelectFilter::make('devise')
                    ->options([
                        'DZD' => 'DZD',
                        'EUR' => 'EUR',
                    ]),

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
            'index' => Pages\ListMouvementCaisses::route('/'),
            'create' => Pages\CreateMouvementCaisse::route('/create'),
            'edit' => Pages\EditMouvementCaisse::route('/{record}/edit'),
        ];
    }
}
