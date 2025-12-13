# Routes & API reference (one-pager)

This file points to the primary route files and lists key flows to document for API/reference.

Primary route files

- `job_app/routes/web.php` — public app web routes (jobs browsing, job detail, application endpoints).
- `job_app/routes/auth.php` — authentication routes for login/register/password reset.
- `job_Backoffice/routes/web.php` — backoffice routes (companies, vacancies, application management).

Key route categories to document (examples)

- Authentication: `GET /login`, `POST /login`, `POST /logout`, `POST /register`.
- Jobs browsing: `GET /jobs`, `GET /jobs/{id}`.
- Applying: `POST /jobs/{id}/apply` (form + resume upload).
- Backoffice: `GET /admin/dashboard`, `GET /admin/jobs`, `POST /admin/jobs`, `PUT /admin/jobs/{id}`, `DELETE /admin/jobs/{id}`.

How to export full route list

```bash
cd job_app
php artisan route:list --path=web

cd ../job_Backoffice
php artisan route:list --path=web
```

If you want, I can generate a machine-readable routes table (CSV/Markdown) from the current route definitions.
