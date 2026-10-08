# AWS EC2 Micro-CMS + Auth System

Final cumulative build from an 18-assignment web technologies course: a
database-backed CMS and authentication system hand-deployed to a real AWS
EC2 instance, built incrementally rather than scaffolded from a template.

## Infrastructure

- Provisioned under a dedicated IAM user (not root), applying least-privilege
  from initial setup.
- nginx configured on the instance with HTTPS via a self-signed TLS certificate.
- MySQL + phpMyAdmin installed and configured on the server.

## Build order

The site was built up in stages across the course, each assignment adding a
layer on top of the last:

1. Static HTML/CSS foundation
2. Bootstrap responsive refactor
3. Client-side JavaScript form validation
4. PHP GET/POST handling and dynamic page rendering
5. A `contact_data` MySQL database capturing form submissions
6. A lightweight CMS: site navigation and page content stored in MySQL
   (`menu` and `pages` tables), with `index.php`/`navigation.php` rewritten
   to render pages and an active-state nav menu dynamically from the
   database — every query uses explicit field selection, no wildcard `SELECT`s
7. A full authentication system: registration with input validation and
   duplicate-username checking, salted SHA-256 password hashing, login with
   server-side session-ID generation persisted to the database, and a
   protected results page that validates the session ID against the
   database before granting access

## This repo

This is the final stage (originally "hw18") — the code as it stood on the
live EC2 instance. Database credentials were pulled out into environment
variables for this repo; see `.env.example`.

## Stack

PHP, MySQL (mysqli), Bootstrap, vanilla JavaScript, nginx, AWS EC2, IAM.
