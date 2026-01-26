<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\project;
use App\Models\reglement;

class ProjectStats extends BaseWidget
{

    protected function getStats(): array
    {

        return [



            Stat::make('Montant total devis', number_format(project::sum('montant_total'), 2) . 'DZD')
                ->icon('heroicon-o-banknotes'),


            Stat::make('Total réglé', Reglement::sum('montant') . 'DZD')
                ->description(project::sum('montant_total')!=0 ?number_format((Reglement::sum('montant') * 100) / project::sum('montant_total'), 2) . '%':'0%')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->chart([7, 2, 10, 3, 15, 4, 17])
                ->color('success'),
            Stat::make('Reste à payer', $rest = project::sum('montant_total') - Reglement::sum('montant'))
                ->description(project::sum('montant_total')!=0 ?number_format(($rest * 100) / project::sum('montant_total'), 2) . '%':'0%')
                ->chart([7, 2, 10, 3, 15, 4, 17])
                ->color('danger'),

        ];
    }
}
