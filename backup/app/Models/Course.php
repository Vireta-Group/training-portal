<?php

namespace App\Models;

use App\Models\Traits\HasInstitute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Course extends Model
{
    use HasInstitute;

    protected $fillable = [
        'institute_id', 'project_id', 'name', 'name_bn', 'duration', 'fee', 'seat_capacity', 'description', 'status',
    ];

    public function institute(): BelongsTo
    {
        return $this->belongsTo(Institute::class);
    }

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }
}
