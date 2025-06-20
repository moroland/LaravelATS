<?php

namespace App\Filament\Resources\PositionResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Components\Actions\Action;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class JobApplicationsRelationManager extends RelationManager
{
    protected static string $relationship = 'jobApplications';


    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('date')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Select::make('applicant_user.name')
                    ->required()
                    ->relationship('applicant_user', 'name'),
                Forms\Components\TextInput::make('status')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('date')
            ->columns([
                Tables\Columns\TextColumn::make('date'),
                Tables\Columns\TextColumn::make('applicant_user.name'),
                Tables\Columns\TextColumn::make('status'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make()
            ]);
    }
}
