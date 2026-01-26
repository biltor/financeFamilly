<?php
namespace App\Filament\Resources\ProjectResource\Widgets;

use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\Project;

class ProjectFinanceWidget extends StatsOverviewWidget
{
    public ?Project $record = null;

    protected function getStats(): array
    {
        $totalRegle = $this->record->reglements()->sum('montant');
        $reste = $this->record->montant_total - $totalRegle;

        return [
            Stat::make('Devis de plateforme', number_format($this->record->montant_total, 2).' DZD')
                ->color('warning'),

            Stat::make('Dépense', number_format($totalRegle, 2).' DZD')
                ->color('danger'),

            Stat::make('Reste devis', number_format($reste, 2).' DZD')
                ->color('success'),
        ];
    }
}
