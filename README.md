# AWS EC2 Micro-CMS + Auth System

This project was built incrementally across 18 assignments, deployed directly to a live AWS EC2 instance via SFTP as each assignment was completed. Git wasn’t part of the original coursework workflow, so this repository captures the final state as a single commit rather than the assignment-by-assignment history.

`hw1` and `hw14` aren't included, they were non-code assignments and were
never deployed to the instance.

## Infrastructure

- Provisioned under a dedicated IAM user (not root), applying least-privilege
  from initial setup.
- nginx configured on the instance with HTTPS via a self-signed TLS certificate.
- MySQL + phpMyAdmin installed and configured on the server.

See [`INCIDENT.md`](./INCIDENT.md) for a production issue hit (and fixed)
while pulling screenshots for this case study.

## Build progression

| Stage | What it added |
|---|---|
| [`hw2`](./hw2) | Single static HTML page |
| [`hw3`](./hw3)–[`hw5`](./hw5) | Multi-page static site (home/contact/hobbies/school/work), styling passes |
| [`hw6`](./hw6)–[`hw7`](./hw7) | Client-side JavaScript introduced (`jstest.html`) |
| [`hw8`](./hw8) | Bootstrap refactor + shopping-cart UI |
| [`hw9`](./hw9) | First PHP (`index.php`, dynamic date) |
| [`hw10`](./hw10)–[`hw11`](./hw11) | GET/POST form handling (`results.php`); `contact.php` converted to PHP |
| [`hw12`](./hw12) | Server-side validation helpers extracted (`functions.php`) |
| [`hw13`](./hw13) | Remaining pages converted to PHP, dynamic navigation (`navigation.php`) |
| [`hw15`](./hw15) | First real DB write — contact form inserts into MySQL |
| [`hw16`](./hw16) | `dbConnect()` helper extracted into `functions.php`; DB read/display (`query_contacts.php`) |
| [`hw17`](./hw17) | Full CMS — nav and page content pulled dynamically from the `cms` database (`menu`/`pages` tables), explicit field selection in every query (no wildcard `SELECT`s) |
| [`hw18`](./hw18) | Full authentication system — registration with input validation and duplicate-username checking, salted SHA-256 password hashing, server-side session-ID generation, and a protected results page that validates the session ID against the database |

`hw18` is the final state and the one referenced in the portfolio case study;
see [`hw18/screenshots/`](./hw18/screenshots) once captured.

## Credentials

Every stage from `hw15` onward connected to MySQL with a hardcoded
`web_user` password in the source. That's been pulled into environment
variables (`getenv('DB_HOST')` / `DB_USER` / `DB_PASSWORD`) across all four
affected files (`hw15/contact.php`, `hw16/functions.php`,
`hw17/functions.php`, `hw18/functions.php`) for this repo. See
`.env.example`.

## Stack

PHP, MySQL (mysqli), Bootstrap, vanilla JavaScript, nginx, AWS EC2, IAM.
