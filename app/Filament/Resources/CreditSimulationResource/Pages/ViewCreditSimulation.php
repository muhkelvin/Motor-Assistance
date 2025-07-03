<?php

namespace App\Filament\Resources\CreditSimulationResource\Pages;

use App\Filament\Resources\CreditSimulationResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewCreditSimulation extends ViewRecord
{
    protected static string $resource = CreditSimulationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
