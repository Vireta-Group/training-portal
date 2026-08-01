<?php

namespace App\Filament\Resources\FeeTypes\Pages;

use App\Filament\Resources\FeeTypes\FeeTypeResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Support\Facades\Auth;

class ListFeeTypes extends ListRecords
{
    protected static string $resource = FeeTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                ->mutateFormDataUsing(fn (array $data): array => [
                    ...$data,
                    'institute_id' => Auth::user()->institute_id,
                ]),
        ];
    }
}
