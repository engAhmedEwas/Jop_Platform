# Deployment checklist & environment matrix

This checklist captures the minimum required services and environment variables for production.

Required services

- Relational database: MySQL 8+ or Postgres
- Object storage: S3-compatible (or local for small installs)
- Queue system: Redis or SQS (for background workers)
- Mail provider: SMTP / Postmark / Resend / SES

Essential environment variables (examples)

- `APP_ENV`, `APP_KEY`, `APP_DEBUG=false`, `APP_URL`
- `DB_CONNECTION`, `DB_HOST`, `DB_PORT`, `DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD`
- `BROADCAST_DRIVER`, `CACHE_DRIVER`, `QUEUE_CONNECTION`, `SESSION_DRIVER`
- `MAIL_MAILER`, `MAIL_HOST`, `MAIL_PORT`, `MAIL_USERNAME`, `MAIL_PASSWORD`, `MAIL_FROM_ADDRESS`
- `AWS_ACCESS_KEY_ID`, `AWS_SECRET_ACCESS_KEY`, `AWS_DEFAULT_REGION`, `AWS_BUCKET` (if using S3)

Deployment steps (summary)

1. Provision infrastructure (DB, Redis, S3, queue workers, app server).
2. Clone repo, install dependencies: `composer install --no-dev`, `npm ci`, build assets `npm run build`.
3. Copy `.env` and set environment variables; run `php artisan key:generate`.
4. Run migrations `php artisan migrate --force` and seeders if needed.
5. Start PHP-FPM + web server (Nginx) and run queue workers / scheduler as systemd services or process manager.

Composer / npm production commands

```bash
composer install --no-dev --optimize-autoloader
npm ci
npm run build
php artisan migrate --force
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

Rollback notes

- Always back up DB before running destructive migrations.
- Use release directories and atomic symlink swap where possible.
