<?php

namespace App\Models;

use App\Models\Traits\HasInstitute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Student extends Model
{
    use HasInstitute;

    /**
     * Casts
     *
     * Ensure dob is handled as a date (Carbon) when retrieved from the database.
     */
    protected $casts = [
        'dob' => 'date',
    ];

    protected $fillable = [
        'institute_id', 'project_id', 'course_id', 'batch_id',
        'name_en', 'name_bn', 'father_name_en', 'father_name_bn',
        'mother_name_en', 'mother_name_bn', 'contact', 'email',
        'dob', 'gender', 'religion', 'nationality', 'blood_group',
        'id_type', 'id_no', 'occupation', 'guardian_contact', 'guardian_relation',
        'present_village', 'present_road', 'present_po', 'present_upazila',
        'present_district', 'present_division',
        'perm_village', 'perm_road', 'perm_po', 'perm_upazila',
        'perm_district', 'perm_division',
        'edu_degree', 'edu_institute', 'edu_year', 'edu_cgpa', 'edu_address',
        'photo_path', 'signature_path', 'nid_path',
        'status', 'reference_no',
    ];

    public function institute(): BelongsTo
    {
        return $this->belongsTo(Institute::class);
    }

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }

    public function batch(): BelongsTo
    {
        return $this->belongsTo(Batch::class);
    }

    public function activityLogs(): HasMany
    {
        return $this->hasMany(ActivityLog::class)->latest();
    }
}
