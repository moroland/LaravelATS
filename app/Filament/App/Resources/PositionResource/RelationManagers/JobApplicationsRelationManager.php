<?php

namespace App\Filament\App\Resources\PositionResource\RelationManagers;

use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class JobApplicationsRelationManager extends RelationManager {
    protected static string $relationship = 'jobApplications';

    protected $listeners = [
        'jobApplied' => '$refresh',
    ];

    public function table(Table $table): Table {
        return $table
            ->recordTitleAttribute('date')
            ->columns([
                Tables\Columns\TextColumn::make('date'),
                Tables\Columns\TextColumn::make('status'),

            ])
            ->modifyQueryUsing(fn(Builder $query) => $query->where('applicant_user_id', auth()->id())
            );

    }
}
