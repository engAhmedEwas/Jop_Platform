# Demo script & checklist

Purpose: provide a minimal sequence to run a demo for stakeholders (local environment).

Prerequisites

- PHP 8.1+ (matched to project), Composer
- Node.js 16+ and npm
- Local database (MySQL or Postgres)

Steps

1. Prepare app (example: `job_app`)

```bash
cd job_app
composer install
cp .env.example .env
# set DB credentials in .env
php artisan key:generate
php artisan migrate --seed
npm install
npm run dev
php artisan serve --host=127.0.0.1 --port=8000
```

2. Backoffice (in new terminal)

```bash
cd job_Backoffice
composer install
cp .env.example .env
# ensure DB points to same database
php artisan migrate --seed
npm install
npm run dev
php artisan serve --host=127.0.0.1 --port=8001
```

Demo checklist (flows to show)

- Register as a job seeker and update profile.
- Browse jobs on `job_app` and open a vacancy.
- Apply to a job with an uploaded resume.
- Switch to `job_Backoffice` and show the application listing, inspect applicant resume, change application status.
- Create/modify a job vacancy in the backoffice and show it appearing on the public site (refresh/build if needed).

Notes

- If background jobs are used for email or processing, run a queue worker: `php artisan queue:work`.
- Use seeded demo accounts if available (seeders may include sample data).
