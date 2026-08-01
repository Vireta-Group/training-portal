<p align="center"><img src="https://img.shields.io/badge/Laravel-12-red?logo=laravel" alt="Laravel 12"> <img src="https://img.shields.io/badge/PHP-8.2-777BB4?logo=php" alt="PHP 8.2"> <img src="https://img.shields.io/badge/PostgreSQL-16-336791?logo=postgresql" alt="PostgreSQL"> <img src="https://img.shields.io/badge/License-MIT-blue"></p>

# TrainingPro — SaaS Training Center Management Platform

**TrainingPro** is a multi-tenant, white-label, Bangla-English bilingual SaaS platform for private training centers and government/NGO skills development projects across Bangladesh.

## Modules

| # | Module | Status |
|---|---|---|
| 01 | Super Admin Dashboard | ❌ Not Started |
| 02 | Tenant Onboarding & Subscription | ❌ Not Started |
| 03 | **Tenant Admin Dashboard** | ✅ Done |
| 04 | Branch Management | ❌ Not Started |
| 05 | **Course & Batch Management** | ✅ Done |
| 06 | **Student Management** | ✅ Done |
| 07 | HR & Employee Management | ❌ Not Started |
| 08 | Enrollment & Fee Management | ❌ Not Started |
| 09 | Payment Gateway Integration | ❌ Not Started |
| 10 | Attendance System | ❌ Not Started |
| 11 | Class Routine & Schedule | ❌ Not Started |
| 12 | Study Materials & Resources | ❌ Not Started |
| 13 | Assessment Management | ❌ Not Started |
| 14 | Question Bank | ❌ Not Started |
| 15 | Exam & Result Management | ❌ Not Started |
| 16 | Certificate Management | ❌ Not Started |
| 17 | Notice Board | ❌ Not Started |
| 18 | SMS & Email Notification | ❌ Not Started |
| 19 | Student & Employee ID Card | ❌ Not Started |
| 20 | **Project-Based Training Management** | ✅ Partial |
| 21 | Marketing & Lead Management | ❌ Not Started |
| 22 | Accounts & Expense Management | ❌ Not Started |
| 23 | Reports & Analytics Dashboard | ❌ Not Started |
| 24 | Student Portal | ❌ Not Started |

## Tech Stack

| Component | Technology |
|---|---|
| Framework | Laravel 12 |
| PHP | 8.2 |
| Database | PostgreSQL |
| Frontend | Blade + Alpine.js |
| CSS | Tailwind CSS |
| Build Tool | Vite |

## Project Structure

```
app/
  Models/          — Batch, Course, Institute, Project, Student, ActivityLog, User
  Http/Controllers — AdmissionController, BatchController, CourseController,
                     InstituteController, ProjectController, StudentController
database/
  migrations/      — 14 migration files covering all tables
resources/views/   — Blade views
routes/
  web.php          — Application routes
plan/
  docs/            — Full SRS documentation for all 24 modules
```

## SRS Documentation

Detailed Software Requirements Specification for all modules is available in [`plan/docs/`](plan/docs/00-index.md).

## Installation

```bash
composer install
npm install && npm run build
cp .env.example .env
php artisan key:generate
php artisan migrate --force
php artisan storage:link
```

## CI/CD

GitHub Actions → FTP Deploy to cPanel shared host (automatic on `main` branch push).

Post-deploy (cPanel Terminal):
```bash
cd public_html
php artisan migrate --force
php artisan optimize
php artisan storage:link
```

## License

MIT © ViretaDev