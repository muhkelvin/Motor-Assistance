<?php

namespace App\Filament\Resources\LeasingCompanyResource\Pages;
use App\Filament\Resources\LeasingCompanyResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewLeasingCompany extends ViewRecord
{
    protected static string $resource = LeasingCompanyResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
