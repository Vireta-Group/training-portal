<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Carbon;

class StudentRequest extends FormRequest
{
    public function authorize(): bool
    {
        // Authorization handled elsewhere (middleware), allow by default
        return true;
    }

    public function rules(): array
    {
        return [
            'project_id' => 'required|exists:projects,id',
            'course_id' => 'required|exists:courses,id',
            'batch_id' => 'nullable|exists:batches,id',
            'name_en' => 'required|max:255',
            'name_bn' => 'nullable|max:255',
            'father_name_en' => 'nullable|max:255',
            'mother_name_en' => 'nullable|max:255',
            'contact' => 'required|max:20',
            'email' => 'nullable|email|max:255',
            // Accept various common formats; normalize in prepareForValidation().
            'dob' => 'nullable|date',
            'gender' => 'nullable|in:Male,Female',
            'religion' => 'nullable|max:50',
            'nationality' => 'nullable|max:50',
            'blood_group' => 'nullable|max:10',
            'occupation' => 'nullable|max:255',
            'status' => 'required|in:applied,admitted,active,inactive,graduated',

            // Additional fields
            'father_name_bn' => 'nullable|max:255',
            'mother_name_bn' => 'nullable|max:255',
            'id_type' => 'nullable|max:50',
            'id_no' => 'nullable|max:100',
            'guardian_contact' => 'nullable|max:20',
            'guardian_relation' => 'nullable|max:100',

            'present_village' => 'nullable|max:255',
            'present_road' => 'nullable|max:255',
            'present_po' => 'nullable|max:100',
            'present_upazila' => 'nullable|max:100',
            'present_district' => 'nullable|max:100',
            'present_division' => 'nullable|max:100',

            'perm_village' => 'nullable|max:255',
            'perm_road' => 'nullable|max:255',
            'perm_po' => 'nullable|max:100',
            'perm_upazila' => 'nullable|max:100',
            'perm_district' => 'nullable|max:100',
            'perm_division' => 'nullable|max:100',

            'edu_degree' => 'nullable|max:255',
            'edu_institute' => 'nullable|max:255',
            'edu_year' => 'nullable|max:10',
            'edu_cgpa' => 'nullable|max:20',
            'edu_address' => 'nullable|max:1000',

            'photo' => 'nullable|file|mimes:jpg,jpeg,png,gif|max:5120',
            'nid' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:10240',
            'signature' => 'nullable|file|mimes:jpg,jpeg,png|max:5120',
        ];
    }

    protected function prepareForValidation(): void
    {
        // Flexible parsing: try several common formats then fallback to Carbon::parse()
        if (! $this->filled('dob')) {
            return;
        }

        $raw = $this->input('dob');

        try {
            // dd-mm-YYYY -> d-m-Y
            if (preg_match('/^\d{2}-\d{2}-\d{4}$/', $raw)) {
                $parsed = Carbon::createFromFormat('d-m-Y', $raw);
            }
            // YYYY-mm-dd -> Y-m-d
            elseif (preg_match('/^\d{4}-\d{2}-\d{2}$/', $raw)) {
                $parsed = Carbon::createFromFormat('Y-m-d', $raw);
            }
            // mm/dd/YYYY -> m/d/Y (common US-style)
            elseif (preg_match('/^\d{2}\/\d{2}\/\d{4}$/', $raw)) {
                $parsed = Carbon::createFromFormat('m/d/Y', $raw);
            } else {
                // Let Carbon try to parse (ISO, textual dates, etc.)
                $parsed = Carbon::parse($raw);
            }

            // If parsed successfully, normalize to Y-m-d and merge
            if (isset($parsed) && $parsed instanceof Carbon) {
                $this->merge(['dob' => $parsed->toDateString()]);
            }
        } catch (\Exception $e) {
            // Parsing failed; leave as-is so validation (nullable|date) will fail and produce an error
        }
    }
}
