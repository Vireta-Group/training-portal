<?php

namespace App\Filament\Resources\Students\Tables;

use App\Models\Batch;
use Filament\Actions\Action;
use Filament\Actions\ActionGroup;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\Select;
use Filament\Notifications\Notification;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class StudentsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name_en')->label('Name')->searchable()->sortable(),
                TextColumn::make('contact')->label('Mobile')->searchable(),
                TextColumn::make('project.name')->label('Project'),
                TextColumn::make('course.name')->label('Course'),
                TextColumn::make('batch.name')->label('Batch'),
                TextColumn::make('status')->label('Status')->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'admitted' => 'success', 'applied' => 'warning', 'rejected' => 'danger', 'active' => 'info', 'graduated' => 'gray', default => 'gray'
                    }),
                TextColumn::make('created_at')->label('Date')->date()->sortable(),
            ])
            ->filters([])
            ->recordActions([
                ActionGroup::make([
                    Action::make('approve')
                        ->label('Admit')
                        ->icon('heroicon-o-check-circle')
                        ->color('success')
                        ->visible(fn ($record) => $record->status === 'applied')
                        ->action(function ($record) {
                            $record->update(['status' => 'admitted']);
                            Notification::make()->success()->title("{$record->name_en} admitted")->send();
                        }),
                    Action::make('reject')
                        ->label('Reject')
                        ->icon('heroicon-o-x-circle')
                        ->color('danger')
                        ->visible(fn ($record) => $record->status === 'applied')
                        ->action(function ($record) {
                            $record->update(['status' => 'rejected']);
                            Notification::make()->danger()->title("{$record->name_en} rejected")->send();
                        }),
                    Action::make('changeBatch')
                        ->label('Change Batch')
                        ->icon('heroicon-o-arrows-right-left')
                        ->form([
                            Select::make('batch_id')
                                ->label('Select Batch')
                                ->options(fn ($record) => Batch::where('course_id', $record->course_id)
                                    ->pluck('name', 'id'))
                                ->required(),
                        ])
                        ->action(function ($record, array $data) {
                            $record->update(['batch_id' => $data['batch_id']]);
                            Notification::make()->success()->title('Batch updated')->send();
                        }),
                    Action::make('removeBatch')
                        ->label('Remove from Batch')
                        ->icon('heroicon-o-user-minus')
                        ->color('warning')
                        ->visible(fn ($record) => $record->batch_id !== null)
                        ->action(function ($record) {
                            $record->update(['batch_id' => null]);
                            Notification::make()->warning()->title("{$record->name_en} removed from batch")->send();
                        }),
                    EditAction::make()->modalWidth('lg'),
                ]),
            ])
            ->toolbarActions([BulkActionGroup::make([DeleteBulkAction::make()])]);
    }
}
