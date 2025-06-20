<?php

namespace App\Filament\Resources\JobApplicationResource\Pages;

use App\Filament\Actions\JobApplicationAcceptAction;
use App\Filament\Actions\JobApplicationRejectAction;
use App\Filament\Resources\JobApplicationResource;
use Filament\Resources\Pages\ViewRecord;

class ViewJobApplication extends ViewRecord
{
    protected static string $resource = JobApplicationResource::class;

    protected $listeners = [
        'applicationAccepted' => '$refresh',
        'applicationRejected' => '$refresh',
    ];

    protected function getHeaderActions(): array
    {
        return [
            //JobApplyAction::make()->disabled(fn () => (bool) Auth::user()->cannot('apply', $this->record))
            JobApplicationAcceptAction::make()->disabled(fn () => $this->record->status == 'accepted'),
            JobApplicationRejectAction::make()->disabled(fn () => $this->record->status == 'rejected'),
        ];
    }
}
