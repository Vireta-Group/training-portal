# STP — Student Training Portal

A multi-institute training management system with a single-page AJAX-driven admin panel. Each institute is scoped to its own data via a global `HasInstitute` scope.

## Tech Stack

- **Laravel** 12 / **PHP** 8.2
- **PostgreSQL** (default connection: `pgsql`)
- **Bootstrap 5** (CDN) + **jQuery** + **AJAX** — single-page CRUD in modals, no page reloads
- **Breeze** (Blade) for authentication
- **Chart.js** for the dashboard charts
- No Filament, no Livewire, no Alpine.js — plain HTML + jQuery
- No npm build step required

## Features

- **Multi-institute scoping** — `HasInstitute` global scope on 16 models; every user only sees their own institute's data
- **Dashboard** — stat cards + admissions pie chart + revenue line chart (loaded via AJAX)
- **Projects** CRUD — name (EN/BN), code, description, status
- **Courses** CRUD — cascading Project → Course selector
- **Batches** CRUD — cascading Project → Course → Batch selector, seat tracking (enrolled/total), per-batch student list with landscape print
- **Students** CRUD — progressive form reveal (Project → Course → Batch), status tabs, file uploads (photo, NID, signature — UUID renamed), profile page, printable application form
- **Cascading selectors** enforced everywhere dependent resources are chosen
- **Print views** — student application form and batch student list (landscape)

## Installation

Requires PHP 8.2+ and PostgreSQL. Works under XAMPP/WAMP.

1. Install dependencies:

   ```bash
   composer install
   ```

2. Copy the environment file:

   ```bash
   copy .env.example .env
   ```

3. Create a PostgreSQL database and configure `.env`:

   ```env
   APP_URL=http://localhost/php/laravel/trainning
   DB_CONNECTION=pgsql
   DB_HOST=127.0.0.1
   DB_PORT=5432
   DB_DATABASE=training_portal
   DB_USERNAME=postgres
   DB_PASSWORD=your_password
   ```

4. Generate the app key:

   ```bash
   php artisan key:generate
   ```

5. Run migrations and seeders:

   ```bash
   php artisan migrate --seed
   ```

   > Note: the database tables are already created if you restored the original DB. Running `php artisan migrate:fresh` will drop them.

6. Create the public storage symlink:

   ```bash
   php artisan storage:link
   ```

7. Serve the app (under XAMPP/WAMP place the project in `htdocs` and visit `http://localhost/php/laravel/trainning`):

   ```bash
   php artisan serve
   ```

## Demo Login

| Email           | Password | Institute |
|-----------------|----------|-----------|
| `demo@stp.com`  | `demo123`| Skill Training Pro |

The `DemoDataSeeder` creates the institute, admin user, 3 projects, courses, batches, students, invoices, and payments.

## Key Routes (Admin)

All under the `admin` prefix, auth-protected:

| Route | Description |
|-------|-------------|
| `/admin` | Dashboard |
| `/admin/projects` | Projects CRUD |
| `/admin/courses` | Courses CRUD (cascades from project) |
| `/admin/batches` | Batches CRUD (cascades from course) + student list / print |
| `/admin/students` | Students CRUD + profile / print |
| `/apply` | Public student application form |

AJAX endpoints follow `admin.<resource>.data`; forms submit via `POST`/`PUT` and return JSON.

## Project Structure

```
app/Http/Controllers/Admin/   — Admin controllers (single-page CRUD + AJAX data)
app/Models/                   — Eloquent models with HasInstitute trait
app/Http/Requests/            — Form request validation (e.g. StudentRequest)
resources/views/admin/        — Admin Blade views (layouts, dashboard, CRUD pages)
resources/views/admin/layouts/master.blade.php — Admin master layout
routes/web.php                — All web routes (public + admin + auth)
plan/FOrm.html                — Design source for the student application print view
```

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
