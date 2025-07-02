<?php

namespace App\Filament\Resources\MotorInstallmentResource\Pages;

use App\Filament\Resources\MotorInstallmentResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditMotorInstallment extends EditRecord
{
    protected static string $resource = MotorInstallmentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
