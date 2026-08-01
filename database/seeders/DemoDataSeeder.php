<?php

namespace Database\Seeders;

use App\Models\Batch;
use App\Models\Course;
use App\Models\FeeType;
use App\Models\Institute;
use App\Models\Invoice;
use App\Models\Payment;
use App\Models\Project;
use App\Models\Student;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DemoDataSeeder extends Seeder
{
    public function run(): void
    {
        $institute = Institute::firstOrCreate(
            ['code' => 'STP001'],
            [
                'name' => 'Skill Training Pro',
                'name_bn' => 'স্কিল ট্রেনিং প্রো',
                'mobile' => '01711111111',
                'email' => 'info@stp.com',
                'address' => 'Dhaka, Bangladesh',
                'status' => 'active',
            ]
        );

        $user = User::firstOrCreate(
            ['email' => 'demo@stp.com'],
            [
                'name' => 'Demo Admin',
                'password' => Hash::make('demo123'),
                'phone' => '01711111111',
                'role' => 'admin',
                'institute_id' => $institute->id,
            ]
        );

        $this->command->info('Login: demo@stp.com / demo123');

        $projects = [
            ['code' => 'ASSES', 'name' => 'ASSES', 'name_bn' => 'এএসএসইএস'],
            ['code' => 'NHRDF', 'name' => 'NHRDF', 'name_bn' => 'এনএইচআরডিএফ'],
            ['code' => 'ISEC', 'name' => 'ISEC', 'name_bn' => 'আইএসইসি'],
        ];

        $coursesData = [
            'ASSES' => [
                ['name' => 'Computer Office Application', 'duration' => 3, 'fee' => 8000, 'seat_capacity' => 30],
                ['name' => 'Graphic Design', 'duration' => 6, 'fee' => 15000, 'seat_capacity' => 25],
                ['name' => 'Web Development', 'duration' => 6, 'fee' => 20000, 'seat_capacity' => 20],
            ],
            'NHRDF' => [
                ['name' => 'Garments Sewing', 'duration' => 3, 'fee' => 5000, 'seat_capacity' => 40],
                ['name' => 'Electrical Wiring', 'duration' => 3, 'fee' => 6000, 'seat_capacity' => 35],
                ['name' => 'Mobile Phone Servicing', 'duration' => 6, 'fee' => 12000, 'seat_capacity' => 25],
            ],
            'ISEC' => [
                ['name' => 'IT Support Specialist', 'duration' => 6, 'fee' => 18000, 'seat_capacity' => 30],
                ['name' => 'Digital Marketing', 'duration' => 3, 'fee' => 10000, 'seat_capacity' => 30],
                ['name' => 'Data Entry & Management', 'duration' => 3, 'fee' => 7000, 'seat_capacity' => 40],
            ],
        ];

        $batchesMap = [];
        $feeTypes = [];
        $courseIds = [];

        foreach ($projects as $proj) {
            $project = Project::firstOrCreate(
                ['institute_id' => $institute->id, 'code' => $proj['code']],
                [
                    'name' => $proj['name'],
                    'name_bn' => $proj['name_bn'],
                    'status' => 'active',
                ]
            );

            $courses = $coursesData[$proj['code']];
            foreach ($courses as $c) {
                $course = Course::firstOrCreate(
                    ['institute_id' => $institute->id, 'project_id' => $project->id, 'name' => $c['name']],
                    [
                        'duration' => $c['duration'],
                        'fee' => $c['fee'],
                        'seat_capacity' => $c['seat_capacity'],
                        'status' => 'active',
                    ]
                );
                $courseIds[$proj['code']][] = $course->id;

                foreach (['Morning', 'Evening'] as $shift) {
                    $batch = Batch::firstOrCreate(
                        [
                            'institute_id' => $institute->id,
                            'course_id' => $course->id,
                            'name' => $c['name'].' ('.$shift.')',
                            'shift' => $shift,
                        ],
                        [
                            'project_id' => $project->id,
                            'seat_capacity' => $c['seat_capacity'],
                            'start_date' => now()->subMonths(2),
                            'end_date' => now()->addMonths($c['duration'] - 2),
                            'status' => 'active',
                        ]
                    );
                    $batchesMap[$project->code][] = $batch->id;
                }
            }

            $fees = [
                ['name' => 'Admission Fee', 'amount' => 500, 'is_optional' => false],
                ['name' => 'Monthly Tuition', 'amount' => 1000, 'is_optional' => false],
                ['name' => 'Exam Fee', 'amount' => 300, 'is_optional' => false],
                ['name' => 'Library Fee', 'amount' => 200, 'is_optional' => true],
                ['name' => 'Certificate Fee', 'amount' => 500, 'is_optional' => true],
            ];

            foreach ($fees as $f) {
                $ft = FeeType::firstOrCreate(
                    ['institute_id' => $institute->id, 'name' => $f['name']],
                    [
                        'amount' => $f['amount'],
                        'is_optional' => $f['is_optional'],
                        'status' => true,
                    ]
                );
                $feeTypes[$project->code][] = $ft->id;
            }
        }

        $studentNames = [
            ['en' => 'Md. Arif Hossain', 'bn' => 'মোঃ আরিফ হোসেন'],
            ['en' => 'Sadia Islam', 'bn' => 'সাদিয়া ইসলাম'],
            ['en' => 'Fahim Rahman', 'bn' => 'ফাহিম রহমান'],
            ['en' => 'Nusrat Jahan', 'bn' => 'নুসরাত জাহান'],
            ['en' => 'Tanvir Ahmed', 'bn' => 'তানভীর আহমেদ'],
            ['en' => 'Sharmin Akter', 'bn' => 'শারমিন আক্তার'],
            ['en' => 'Rakibul Hasan', 'bn' => 'রাকিবুল হাসান'],
            ['en' => 'Farzana Hossain', 'bn' => 'ফারজানা হোসেন'],
            ['en' => 'Jahidul Islam', 'bn' => 'জাহিদুল ইসলাম'],
            ['en' => 'Moumita Das', 'bn' => 'মৌমিতা দাস'],
            ['en' => 'Shahin Alam', 'bn' => 'শাহিন আলম'],
            ['en' => 'Rokeya Begum', 'bn' => 'রোকেয়া বেগম'],
        ];

        $districts = ['Dhaka', 'Chattogram', 'Rajshahi', 'Khulna', 'Sylhet', 'Barishal', 'Rangpur', 'Mymensingh'];
        $occupations = ['Student', 'Job Holder', 'Business', 'Unemployed', 'Housewife'];
        $genders = ['Male', 'Female'];
        $religions = ['Islam', 'Hinduism', 'Buddhism', 'Christianity'];

        $studentNum = 0;
        $batchAll = Batch::where('institute_id', $institute->id)->get();

        foreach ($batchAll as $batch) {
            $studentsInBatch = min(5, count($studentNames) - $studentNum);
            for ($j = 0; $j < $studentsInBatch && $studentNum < count($studentNames); $j++) {
                $s = $studentNames[$studentNum];
                $gender = ($j % 2 === 0) ? 'Male' : 'Female';
                $district = $districts[array_rand($districts)];
                $occupation = $occupations[array_rand($occupations)];
                $religion = $religions[array_rand($religions)];

                $student = Student::create([
                    'institute_id' => $institute->id,
                    'project_id' => $batch->project_id,
                    'course_id' => $batch->course_id,
                    'batch_id' => $batch->id,
                    'name_en' => $s['en'],
                    'name_bn' => $s['bn'],
                    'father_name_en' => 'Md. '.explode(' ', $s['en'])[0].' Ali',
                    'mother_name_en' => 'Mrs. '.explode(' ', $s['en'])[0].' Khatun',
                    'contact' => '017'.str_pad((10000000 + $studentNum), 8, '0', STR_PAD_LEFT),
                    'email' => strtolower(str_replace([' ', '.'], '', $s['en'])).'@mail.com',
                    'dob' => now()->subYears(rand(18, 40))->subDays(rand(1, 365)),
                    'gender' => $gender,
                    'religion' => $religion,
                    'nationality' => 'Bangladeshi',
                    'blood_group' => ['A+', 'A-', 'B+', 'B-', 'O+', 'O-', 'AB+', 'AB-'][array_rand(['A+', 'A-', 'B+', 'B-', 'O+', 'O-', 'AB+', 'AB-'])],
                    'id_type' => 'NID',
                    'id_no' => (1234567890 + $studentNum),
                    'occupation' => $occupation,
                    'guardian_contact' => '017'.str_pad((90000000 + $studentNum), 8, '0', STR_PAD_LEFT),
                    'guardian_relation' => 'Father',
                    'present_village' => 'Demo Village',
                    'present_road' => 'Road #'.($studentNum + 1),
                    'present_po' => 'Demo PO',
                    'present_upazila' => 'Demo Upazila',
                    'present_district' => $district,
                    'present_division' => $district,
                    'perm_village' => 'Demo Village',
                    'perm_road' => 'Road #'.($studentNum + 1),
                    'perm_po' => 'Demo PO',
                    'perm_upazila' => 'Demo Upazila',
                    'perm_district' => $district,
                    'perm_division' => $district,
                    'status' => 'admitted',
                    'reference_no' => 'STP-'.str_pad($studentNum + 1, 5, '0', STR_PAD_LEFT),
                ]);

                $course = Course::find($batch->course_id);
                $feeAmt = $course ? $course->fee : 10000;
                $paidAmt = rand(0, 1) ? $feeAmt : round($feeAmt * rand(3, 8) / 10, -2);

                $invoice = Invoice::create([
                    'institute_id' => $institute->id,
                    'student_id' => $student->id,
                    'batch_id' => $batch->id,
                    'invoice_no' => 'INV-'.str_pad($student->id, 5, '0', STR_PAD_LEFT),
                    'total_amount' => $feeAmt,
                    'paid_amount' => $paidAmt,
                    'due_amount' => $feeAmt - $paidAmt,
                    'due_date' => now()->addDays(30),
                    'status' => $paidAmt >= $feeAmt ? 'paid' : 'partial',
                ]);

                $ftIds = FeeType::where('institute_id', $institute->id)->pluck('id')->toArray();
                Payment::create([
                    'institute_id' => $institute->id,
                    'student_id' => $student->id,
                    'invoice_id' => $invoice->id,
                    'fee_type_id' => $ftIds[array_rand($ftIds)],
                    'amount' => $paidAmt,
                    'payment_date' => now()->subDays(rand(1, 60)),
                    'payment_method' => ['Cash', 'bKash', 'Nagad', 'Bank'][array_rand(['Cash', 'bKash', 'Nagad', 'Bank'])],
                    'reference_no' => 'TXN'.str_pad($student->id, 8, '0', STR_PAD_LEFT),
                ]);

                $studentNum++;
            }
        }

        $this->command->info('Demo data inserted successfully!');
        $this->command->info('Institutes: '.Institute::count());
        $this->command->info('Users: '.User::count());
        $this->command->info('Projects: '.Project::count());
        $this->command->info('Courses: '.Course::count());
        $this->command->info('Batches: '.Batch::count());
        $this->command->info('Fee Types: '.FeeType::count());
        $this->command->info('Students: '.Student::count());
        $this->command->info('Invoices: '.Invoice::count());
        $this->command->info('Payments: '.Payment::count());
    }
}
