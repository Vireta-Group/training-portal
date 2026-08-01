<?php

namespace App\Filament\Resources\FeeTypes\Pages;

use App\Filament\Resources\FeeTypes\FeeTypeResource;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Auth;

class CreateFeeType extends CreateRecord
{
    protected static string $resource = FeeTypeResource::class;

    protected function mutateFormData(array $data): array
    {
        $data['institute_id'] = Auth::user()->institute_id;

        return $data;
    }
}
