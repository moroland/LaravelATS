<?php

namespace App\Filament\App\Resources\PositionResource\Pages;

use App\Filament\App\Actions\JobApplyAction;
use App\Filament\App\Resources\PositionResource;
use Filament\Resources\Pages\ViewRecord;

class ViewPosition extends ViewRecord
{
    protected static string $resource = PositionResource::class;

    protected $listeners = [
        'jobApplied' => '$refresh',
    ];

    protected function getHeaderActions(): array
    {
        return [
            JobApplyAction::make()//->disabled(fn () => (bool) Auth::user()->cannot('apply', $this->record))
        ];
    }


}
