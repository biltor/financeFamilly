<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ClientResource\Pages;
use App\Filament\Resources\ClientResource\RelationManagers;
use App\Models\Client;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ClientResource extends Resource
{
    protected static ?string $model = Client::class;

    protected static ?int $navigationSort = 2;

    protected static ?string  $navigationGroup = 'CRM';

    protected static ?string $navigationIcon = 'heroicon-o-users';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informations du client')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->label('Nom')
                            ->required()
                            ->maxLength(255),

                        Forms\Components\Select::make('fonction_id')
                            ->label('Fonction')
                            ->required()
                            ->relationship('fonction', 'name')
                            ->searchable()
                            ->preload()
                            ->native(false),
                        // ... vos autres champs
                        Forms\Components\Select::make('user_id')
                            ->label('Compte Utilisateur')
                            ->relationship(
                                name: 'user',
                                titleAttribute: 'email',
                                modifyQueryUsing: function ($query, $record) {
                                    return $query->whereDoesntHave('client', function ($q) use ($record) {
                                        // On exclut les utilisateurs qui ont déjà un client...
                                        if ($record && $record->user_id) {
                                            // ...sauf l'utilisateur actuel du client qu'on est en train de modifier
                                            $q->where('user_id', '!=', $record->user_id);
                                        }
                                    });
                                }
                            )
                            ->searchable()
                            ->preload()
                            ->helperText('Seuls les utilisateurs sans client sont listés.')



                    ])
                    ->columns(2),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Nom')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('fonction.name')
                    ->label('Fonction')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('user.name')
                    ->label('Utilisateur')
                    ->placeholder('Aucun compte'),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Créé le')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])




            ->filters([
                Tables\Filters\SelectFilter::make('fonction')
                    ->relationship('fonction', 'name')
                    ->searchable()
                    ->preload(),

                Tables\Filters\Filter::make('has_user')
                    ->label('Avec utilisateur')
                    ->query(fn(Builder $query): Builder => $query->whereNotNull('user_id')),

                Tables\Filters\Filter::make('no_user')
                    ->label('Sans utilisateur')
                    ->query(fn(Builder $query): Builder => $query->whereNull('user_id')),
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
            'index' => Pages\ListClients::route('/'),
            'create' => Pages\CreateClient::route('/create'),
            'edit' => Pages\EditClient::route('/{record}/edit'),
        ];
    }
}
