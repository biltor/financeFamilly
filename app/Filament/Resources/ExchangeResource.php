<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ExchangeResource\Pages;
use App\Filament\Resources\ExchangeResource\RelationManagers;
use App\Models\exchange;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Services\mouvCaiisService;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Grid;
use Filament\Tables\Columns\BadgeColumn;


class ExchangeResource extends Resource
{
    protected static ?string $model = exchange::class;
    protected static ?string $pluralModelLabel = 'Exchanges /Transfer';

    protected static ?int $navigationSort = 1;


    protected static ?string  $navigationGroup = 'Comptabilité';

    protected static ?string $navigationIcon = 'heroicon-o-arrow-path-rounded-square';

    public static function form(Form $form): Form
    {
          return $form->schema([

        Section::make('Détails de l’opération')
            ->schema([

                Grid::make(2)->schema([

                    // ───── Ligne 1 (plein largeur)
                    Forms\Components\Select::make('type_operation')
                        ->label("Type d'opération")
                        ->options([
                            'trans' => 'Transfert',
                            'exch'  => 'Exchange',
                        ])
                        ->required(),
                    Forms\Components\Select::make('caisse_src_id')
                        ->label('Caisse source')
                        ->relationship('caisseSource', 'title')
                        ->required(),



                    // ───── Ligne 2
                    Forms\Components\TextInput::make('montant')
                        ->label('Montant source')
                        ->numeric()
                        ->required(),

                    Forms\Components\Select::make('currency_src')
                        ->label('Devise source')
                        ->options([
                            'EUR' => 'EUR',
                            'DZD' => 'DZD',
                        ])
                        ->default('DZD')
                        ->required(),

                    // ───── Ligne 3
                    Forms\Components\TextInput::make('taux')
                        ->label('Taux de change')
                        ->numeric()
                        ->required(),

                    Forms\Components\DatePicker::make('date_change')
                        ->label('Date de change')
                        ->default(now())
                        ->required(),

                    // ───── Ligne 4
                   Forms\Components\Select::make('caisse_dest_id')
                       ->label('Caisse destination')
                       ->relationship('caisseDestination', 'title')
                       ->required(),

                    Forms\Components\Select::make('currency_dest')
                        ->label('Devise destination')
                        ->options([
                            'EUR' => 'EUR',
                            'DZD' => 'DZD',
                        ])
                        ->default('EUR')
                        ->required(),
                ]),
            ])
            ->collapsible(),

        // ─────────────────────────────
        // SECTION RESULTAT
        // ─────────────────────────────

        Section::make('Résultat')
            ->schema([
                Grid::make(2)->schema([

                    Forms\Components\Placeholder::make('total_src')
                        ->label('Total source')
                        ->content(fn (callable $get) =>
                            $get('montant')
                                ? number_format($get('montant'), 2, ',', ' ')
                                . ' ' . $get('currency_src')
                                : '—'
                        ),

                    Forms\Components\Placeholder::make('total_dest')
                        ->label('Total destination')
                        ->content(function (callable $get) {
                            $montant = (float) $get('montant');
                            $taux = (float) $get('taux');

                            return ($montant && $taux)
                                ? number_format($montant * $taux, 2, ',', ' ')
                                  . ' ' . $get('currency_dest')
                                : '—';
                        }),
                ]),
            ])
            ->extraAttributes([
                'class' => 'bg-gray-50 border rounded-xl',
            ]),
    ]);



    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([

            // ───── Caisses (Source → Destination)
            Tables\Columns\TextColumn::make('caisseSource.title')
                ->label('Caisse source')
                ->sortable()
                ->searchable(),

            Tables\Columns\TextColumn::make('caisseDestination.title')
                ->label('Caisse destination')
                ->sortable()
                ->searchable(),

            // ───── Montant source
           Tables\Columns\TextColumn::make('montant')
                ->label('Montant source')
                ->money(fn ($record) => $record->currency_src)
                ->sortable(),

            // ───── Taux
           Tables\Columns\TextColumn::make('taux')
                ->label('Taux')
                ->numeric(4)
                ->sortable(),

            // ───── Montant destination (calculé)
            Tables\Columns\TextColumn::make('montant_dest')
                ->label('Montant destination')
                ->getStateUsing(fn ($record) =>
                    $record->montant * $record->taux
                )
                ->money(fn ($record) => $record->currency_dest),

            // ───── Date
            Tables\Columns\TextColumn::make('date_change')
                ->label('Date')
                ->date()
                ->sortable(),
            ])
            ->defaultSort('date_change', 'desc')
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
            'index' => Pages\ListExchanges::route('/'),
            'create' => Pages\CreateExchange::route('/create'),
            'edit' => Pages\EditExchange::route('/{record}/edit'),
        ];
    }
}
