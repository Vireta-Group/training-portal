<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        $permissions = [
            ['name' => 'View Settings',        'slug' => 'settings.view',       'group' => 'Settings'],
            ['name' => 'Update Settings',      'slug' => 'settings.update',     'group' => 'Settings'],
            ['name' => 'View Institute',       'slug' => 'institute.view',      'group' => 'Institute'],
            ['name' => 'Update Institute',     'slug' => 'institute.update',    'group' => 'Institute'],
            ['name' => 'Manage Users',         'slug' => 'users.manage',        'group' => 'Users'],
            ['name' => 'View Projects',        'slug' => 'projects.view',       'group' => 'Project'],
            ['name' => 'Create Projects',      'slug' => 'projects.create',     'group' => 'Project'],
            ['name' => 'Edit Projects',        'slug' => 'projects.edit',       'group' => 'Project'],
            ['name' => 'Delete Projects',      'slug' => 'projects.delete',     'group' => 'Project'],
            ['name' => 'View Courses',         'slug' => 'courses.view',        'group' => 'Course'],
            ['name' => 'Create Courses',       'slug' => 'courses.create',      'group' => 'Course'],
            ['name' => 'Edit Courses',         'slug' => 'courses.edit',        'group' => 'Course'],
            ['name' => 'Delete Courses',       'slug' => 'courses.delete',      'group' => 'Course'],
            ['name' => 'View Batches',         'slug' => 'batches.view',        'group' => 'Batch'],
            ['name' => 'Create Batches',       'slug' => 'batches.create',      'group' => 'Batch'],
            ['name' => 'Edit Batches',         'slug' => 'batches.edit',        'group' => 'Batch'],
            ['name' => 'Delete Batches',       'slug' => 'batches.delete',      'group' => 'Batch'],
            ['name' => 'View Admissions',      'slug' => 'admissions.view',     'group' => 'Admission'],
            ['name' => 'Approve Admissions',   'slug' => 'admissions.approve',  'group' => 'Admission'],
            ['name' => 'Reject Admissions',    'slug' => 'admissions.reject',   'group' => 'Admission'],
            ['name' => 'View Students',        'slug' => 'students.view',       'group' => 'Student'],
            ['name' => 'Edit Students',        'slug' => 'students.edit',       'group' => 'Student'],
            ['name' => 'View Attendance',      'slug' => 'attendance.view',     'group' => 'Attendance'],
            ['name' => 'Mark Attendance',      'slug' => 'attendance.mark',     'group' => 'Attendance'],
            ['name' => 'View Payments',        'slug' => 'payments.view',       'group' => 'Payment'],
            ['name' => 'Create Payments',      'slug' => 'payments.create',     'group' => 'Payment'],
            ['name' => 'View Invoices',        'slug' => 'invoices.view',       'group' => 'Invoice'],
            ['name' => 'Create Invoices',      'slug' => 'invoices.create',     'group' => 'Invoice'],
            ['name' => 'View Fee Types',       'slug' => 'fee-types.view',      'group' => 'Fee Type'],
            ['name' => 'Manage Fee Types',     'slug' => 'fee-types.manage',    'group' => 'Fee Type'],
            ['name' => 'View Expenses',        'slug' => 'expenses.view',       'group' => 'Expense'],
            ['name' => 'Manage Expenses',      'slug' => 'expenses.manage',     'group' => 'Expense'],
            ['name' => 'View Departments',     'slug' => 'departments.view',    'group' => 'HR'],
            ['name' => 'Manage Departments',   'slug' => 'departments.manage',  'group' => 'HR'],
            ['name' => 'View Designations',    'slug' => 'designations.view',   'group' => 'HR'],
            ['name' => 'Manage Designations',  'slug' => 'designations.manage', 'group' => 'HR'],
            ['name' => 'View Employees',       'slug' => 'employees.view',      'group' => 'HR'],
            ['name' => 'Manage Employees',     'slug' => 'employees.manage',    'group' => 'HR'],
            ['name' => 'View HR Attendance',   'slug' => 'hr-attendance.view',  'group' => 'HR'],
            ['name' => 'Mark HR Attendance',   'slug' => 'hr-attendance.mark',  'group' => 'HR'],
            ['name' => 'View Exams',           'slug' => 'exams.view',          'group' => 'Exam'],
            ['name' => 'Create Exams',         'slug' => 'exams.create',        'group' => 'Exam'],
            ['name' => 'Edit Exams',           'slug' => 'exams.edit',          'group' => 'Exam'],
            ['name' => 'Delete Exams',         'slug' => 'exams.delete',        'group' => 'Exam'],
            ['name' => 'View Results',         'slug' => 'results.view',        'group' => 'Result'],
            ['name' => 'Update Results',       'slug' => 'results.update',      'group' => 'Result'],
            ['name' => 'View Reports',         'slug' => 'reports.view',        'group' => 'Report'],
            ['name' => 'Generate Reports',     'slug' => 'reports.generate',    'group' => 'Report'],
            ['name' => 'View Certificates',    'slug' => 'certificates.view',   'group' => 'Certificate'],
            ['name' => 'Issue Certificates',   'slug' => 'certificates.issue',  'group' => 'Certificate'],
        ];

        $inserted = collect();
        foreach ($permissions as $perm) {
            $inserted->push(Permission::firstOrCreate(['slug' => $perm['slug']], $perm));
        }

        $roles = [
            'super-admin' => [
                'name' => 'Super Admin',
                'description' => 'Full access to everything including platform settings',
                'permissions' => $permissions,
            ],
            'institute-admin' => [
                'name' => 'Institute Admin',
                'description' => 'Full access to own institute except global settings',
                'permissions' => array_filter($permissions, fn ($p) => $p['group'] !== 'Settings'),
            ],
            'manager' => [
                'name' => 'Manager',
                'description' => 'Operational access without Settings & User management',
                'permissions' => array_filter($permissions, fn ($p) => ! in_array($p['group'], ['Settings', 'Users'])),
            ],
            'accounts' => [
                'name' => 'Accounts',
                'description' => 'Payment, invoice & expense management',
                'permissions' => array_filter($permissions, fn ($p) => in_array($p['group'], ['Payment', 'Invoice', 'Fee Type', 'Expense', 'Report'])),
            ],
            'teacher' => [
                'name' => 'Teacher',
                'description' => 'Attendance, exams & results for own batches only',
                'permissions' => array_filter($permissions, fn ($p) => in_array($p['slug'], [
                    'attendance.view', 'attendance.mark',
                    'exams.view', 'exams.create', 'exams.edit',
                    'results.view', 'results.update',
                    'students.view',
                    'courses.view', 'batches.view',
                ])),
            ],
            'staff' => [
                'name' => 'Staff',
                'description' => 'Front desk: admission, student & payment lookup',
                'permissions' => array_filter($permissions, fn ($p) => in_array($p['slug'], [
                    'admissions.view', 'students.view', 'students.edit',
                    'courses.view', 'batches.view',
                    'payments.view',
                    'attendance.view',
                ])),
            ],
            'student' => [
                'name' => 'Student',
                'description' => 'Own profile, certificate download, payment history',
                'permissions' => array_filter($permissions, fn ($p) => in_array($p['slug'], [
                    'payments.view', 'certificates.view',
                ])),
            ],
        ];

        foreach ($roles as $slug => $data) {
            $role = Role::firstOrCreate(
                ['slug' => $slug],
                ['name' => $data['name'], 'description' => $data['description']]
            );
            $permIds = collect($data['permissions'])->pluck('slug')->toArray();
            $role->permissions()->sync(
                Permission::whereIn('slug', $permIds)->pluck('id')
            );
        }
    }
}
