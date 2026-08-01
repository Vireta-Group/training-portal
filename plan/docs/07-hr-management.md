# Module 07: HR & Employee Management

**Status:** ❌ Not Started  
**Business Value:** Manage trainers and staff salary, leave, and performance

## Features
- Joining date, salary structure, leave balance
- Employee attendance & payroll
- Trainer performance rating

## Database Tables Required
- `employees`
- `employee_salaries`
- `employee_leaves`
- `employee_attendance`

## Relationships
- Employee → Branch (belongs-to)
- Employee → User (one-to-one, auth)
- Employee → Salary (one-to-many)
- Employee → Leave (one-to-many)