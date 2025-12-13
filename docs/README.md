Project overview — Job Portal (Public + Backoffice)

This repository contains two Laravel applications:

- `job_app/` — public-facing job portal for job seekers and employers.
- `job_Backoffice/` — admin/backoffice application for managing companies, jobs, and applications.

This `docs/` folder contains short, stakeholder-friendly artifacts to explain the project:

- `ARCHITECTURE.md` — high-level architecture diagram (PlantUML) and explanation.
- `ERD.puml` — Entity Relationship Diagram for main models.
- `ROUTES.md` — concise routes / API reference.
- `DEMO.md` — step-by-step demo script and checklist.
- `DEPLOY.md` — deployment checklist and required environment variables.
- `SLIDES.md` — 5–7 slide deck outline for executive/demo presentation.

Quickstart (local development)

1. Install PHP and Composer, Node.js and npm.

2. For the app you want to run (example: `job_app`):

```bash
cd job_app
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate --seed
npm install
npm run dev
php artisan serve --host=127.0.0.1 --port=8000
```

3. Open the site at http://127.0.0.1:8000 and the backoffice app similarly (run its server in `job_Backoffice`).

Files to review first

- `job_app/app/Models/User.php`
- `job_app/app/Models/JobVacancy.php`
- `job_app/routes/web.php`
- `job_Backoffice/app/Http/Controllers/DashboardController.php`

If you'd like, I can: update the root `job_app/README.md`, generate diagram images from PlantUML, or produce the slide deck PDF.

Rendered diagrams

I generated diagram SVGs and saved them to:

- `docs/images/erd.svg`
- `docs/images/architecture.svg`

If you'd like PNG versions instead, tell me and I will add them.
