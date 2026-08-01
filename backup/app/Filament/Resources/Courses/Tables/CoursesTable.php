<?php

namespace App\Filament\Resources\Courses\Tables;

use App\Models\Project;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class CoursesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->label('Name')->searchable()->sortable(),
                TextColumn::make('project.name')->label('Project')->searchable()->sortable(),
                TextColumn::make('duration')->label('Duration')->suffix(' months'),
                TextColumn::make('fee')->label('Fee')->money('BDT')->sortable(),
                TextColumn::make('status')->label('Status')->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'active' => 'success', 'inactive' => 'danger'
                    }),
            ])
            ->filters([
                SelectFilter::make('project_id')
                    ->label('Project')
                    ->options(fn () => Project::where('status', 'active')->pluck('name', 'id')),
            ])
            ->recordActions([EditAction::make()->modalWidth('lg')])
            ->toolbarActions([BulkActionGroup::make([DeleteBulkAction::make()])]);
    }
}
