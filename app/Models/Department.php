<?php

namespace App\Models;

use App\Models\Traits\HasInstitute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Department extends Model
{
    use HasInstitute;

    protected $fillable = ['institute_id', 'name', 'name_bn', 'description', 'status'];

    public function institute(): BelongsTo
    {
        return $this->belongsTo(Institute::class);
    }

    public function employees(): HasMany
    {
        return $this->hasMany(Employee::class);
    }
}
