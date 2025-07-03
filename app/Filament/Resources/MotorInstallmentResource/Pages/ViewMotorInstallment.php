<?php

namespace App\Filament\Resources\MotorInstallmentResource\Pages;

use App\Filament\Resources\MotorInstallmentResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewMotorInstallment extends ViewRecord
{
    protected static string $resource = MotorInstallmentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
