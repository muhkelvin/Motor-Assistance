<?php

namespace App\Filament\Resources\InquiryResource\Pages;

use App\Filament\Resources\InquiryResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewInquiry extends ViewRecord
{
    protected static string $resource = InquiryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
            Actions\Action::make('contact')
                ->icon('heroicon-o-phone')
                ->color('success')
                ->action(function () {
                    $this->record->update([
                        'status' => 'contacted',
                        'contacted_at' => now(),
                    ]);

                    $this->refreshFormData(['status', 'contacted_at']);
                })
                ->visible(fn () => $this->record->status === 'new'),
        ];
    }
}
