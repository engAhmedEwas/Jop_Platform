Architecture — high-level overview

This page contains a compact architecture description and a PlantUML diagram to show boundaries and data flow.

Conceptual boundaries

- Public site (`job_app`) — user registration, job browsing, applying, resume upload.
- Backoffice (`job_Backoffice`) — admin interface for companies, job postings, and reviewing applications.
- Shared services — relational database (MySQL/Postgres), queues (Redis/SQS), mail providers (SMTP/Postmark/Resend), file storage (local/S3).

Simple PlantUML diagram (render with PlantUML or https://plantuml.com/):

```plantuml
@startuml
actor "Job Seeker" as S
actor "Employer/Admin" as A

rectangle "Public App (job_app)" {
  S --> (Browse Jobs)
  S --> (Apply / Upload Resume)
}

rectangle "Backoffice (job_Backoffice)" {
  A --> (Manage Companies)
  A --> (Manage Job Vacancies)
  A --> (Review Applications)
}

database "DB (MySQL/Postgres)" as DB
queue "Queue (Redis/SQS)" as Q
storage "File Storage (S3/local)" as FS

(Apply / Upload Resume) --> Q : enqueue email/processing
Q --> (Background Workers)
(Manage Job Vacancies) --> DB
(Browse Jobs) --> DB
(Review Applications) --> DB
(Apply / Upload Resume) --> FS

DB .. FS : stores file metadata
@enduml
```

Notes

- Use the diagram to show where background workers and external services (mail, storage) sit.
- I can render PNG/SVG outputs from these PlantUML files on request.
