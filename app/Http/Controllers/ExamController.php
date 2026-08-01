<?php

namespace App\Http\Controllers;

use App\Models\Batch;
use App\Models\Exam;
use App\Models\Project;
use App\Models\Result;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExamController extends Controller
{
    private function getProjectId()
    {
        return session('current_project_id', optional(Project::where('institute_id', Auth::user()->institute_id)->first())->id);
    }

    public function index()
    {
        $exams = Exam::with(['batch', 'course'])
            ->where('institute_id', Auth::user()->institute_id)
            ->orderBy('exam_date', 'desc')
            ->get();

        return view('exams.index', compact('exams'));
    }

    public function create()
    {
        $batches = Batch::with('course')
            ->where('institute_id', Auth::user()->institute_id)
            ->where('project_id', $this->getProjectId())
            ->where('status', 'active')
            ->orderBy('name')
            ->get();

        return view('exams.create', compact('batches'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'batch_id' => 'required|exists:batches,id',
            'name' => 'required|string|max:255',
            'name_bn' => 'nullable|string|max:255',
            'type' => 'required|in:quiz,midterm,final,model_test,retake',
            'exam_date' => 'required|date',
            'total_marks' => 'required|numeric|min:1',
            'passing_marks' => 'required|numeric|min:0|lte:total_marks',
            'description' => 'nullable|string',
        ]);

        $batch = Batch::findOrFail($request->batch_id);
        abort_if($batch->institute_id !== Auth::user()->institute_id, 403);

        Exam::create([
            'institute_id' => Auth::user()->institute_id,
            'batch_id' => $request->batch_id,
            'course_id' => $request->course_id ?? $batch->course_id,
            'name' => $request->name,
            'name_bn' => $request->name_bn,
            'type' => $request->type,
            'exam_date' => $request->exam_date,
            'total_marks' => $request->total_marks,
            'passing_marks' => $request->passing_marks,
            'description' => $request->description,
        ]);

        return redirect()->route('exams.index')->with('success', 'Exam created successfully.');
    }

    public function show(Exam $exam)
    {
        abort_if($exam->institute_id !== Auth::user()->institute_id, 403);
        $exam->load(['batch.course', 'results.student']);

        return view('exams.show', compact('exam'));
    }

    public function edit(Exam $exam)
    {
        abort_if($exam->institute_id !== Auth::user()->institute_id, 403);

        $batches = Batch::with('course')
            ->where('institute_id', Auth::user()->institute_id)
            ->where('status', 'active')
            ->orderBy('name')
            ->get();

        return view('exams.edit', compact('exam', 'batches'));
    }

    public function update(Request $request, Exam $exam)
    {
        abort_if($exam->institute_id !== Auth::user()->institute_id, 403);

        $request->validate([
            'batch_id' => 'required|exists:batches,id',
            'name' => 'required|string|max:255',
            'type' => 'required|in:quiz,midterm,final,model_test,retake',
            'exam_date' => 'required|date',
            'total_marks' => 'required|numeric|min:1',
            'passing_marks' => 'required|numeric|min:0|lte:total_marks',
            'description' => 'nullable|string',
            'status' => 'required|string|in:pending,ongoing,completed,cancelled',
        ]);

        $exam->update($request->all());

        return redirect()->route('exams.index')->with('success', 'Exam updated successfully.');
    }

    public function marks(Exam $exam)
    {
        abort_if($exam->institute_id !== Auth::user()->institute_id, 403);

        $students = Student::where('institute_id', Auth::user()->institute_id)
            ->where('batch_id', $exam->batch_id)
            ->where('status', 'admitted')
            ->orderBy('name_en')
            ->get();

        $results = Result::where('exam_id', $exam->id)->get()->keyBy('student_id');

        return view('exams.marks', compact('exam', 'students', 'results'));
    }

    public function saveMarks(Request $request, Exam $exam)
    {
        abort_if($exam->institute_id !== Auth::user()->institute_id, 403);

        $request->validate([
            'marks' => 'required|array',
            'marks.*.student_id' => 'required|exists:students,id',
            'marks.*.marks_obtained' => 'required|numeric|min:0|max:'.$exam->total_marks,
            'marks.*.remarks' => 'nullable|string|max:500',
        ]);

        foreach ($request->marks as $data) {
            $marksObtained = $data['marks_obtained'];
            $gpa = $exam->total_marks > 0 ? round(($marksObtained / $exam->total_marks) * 5, 2) : 0;
            $gpa = min($gpa, 5.00);
            $grade = $this->calculateGrade($marksObtained, $exam->total_marks);

            Result::updateOrCreate(
                [
                    'exam_id' => $exam->id,
                    'student_id' => $data['student_id'],
                ],
                [
                    'institute_id' => Auth::user()->institute_id,
                    'marks_obtained' => $marksObtained,
                    'grade' => $grade,
                    'gpa' => $gpa,
                    'remarks' => $data['remarks'] ?? null,
                ]
            );
        }

        $exam->update(['status' => 'completed']);

        return redirect()->route('exams.show', $exam->id)->with('success', 'Marks saved successfully.');
    }

    private function calculateGrade(float $marks, float $total): string
    {
        $percentage = $total > 0 ? ($marks / $total) * 100 : 0;

        return match (true) {
            $percentage >= 80 => 'A+',
            $percentage >= 70 => 'A',
            $percentage >= 60 => 'A-',
            $percentage >= 50 => 'B',
            $percentage >= 40 => 'C',
            $percentage >= 33 => 'D',
            default => 'F',
        };
    }

    public function destroy(Exam $exam)
    {
        abort_if($exam->institute_id !== Auth::user()->institute_id, 403);
        $exam->delete();

        return redirect()->route('exams.index')->with('success', 'Exam deleted successfully.');
    }
}
