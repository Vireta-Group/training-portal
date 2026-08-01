<?php

namespace App\Models;

use App\Models\Traits\HasInstitute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class FeeType extends Model
{
    use HasInstitute;

    protected $fillable = [
        'institute_id', 'name', 'name_bn', 'amount', 'description',
        'is_optional', 'status',
    ];

    protected function casts(): array
    {
        return [
            'is_optional' => 'boolean',
            'status' => 'boolean',
            'amount' => 'decimal:2',
        ];
    }

    public function institute(): BelongsTo
    {
        return $this->belongsTo(Institute::class);
    }

    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class);
    }
}
