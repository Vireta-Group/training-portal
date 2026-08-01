<?php

namespace App\Filament\Resources\Designations\Pages;

use App\Filament\Resources\Designations\DesignationResource;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Auth;

class CreateDesignation extends CreateRecord
{
    protected static string $resource = DesignationResource::class;

    protected function mutateFormData(array $data): array
    {
        $data['institute_id'] = Auth::user()->institute_id;

        return $data;
    }
}
