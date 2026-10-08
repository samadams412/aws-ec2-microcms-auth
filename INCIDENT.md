# Incident: MySQL OOM-kill, 2026-09-07

Backup documentation. The full write-up is going on DailyBlog — this is
just the factual record.

## What happened

The EC2 instance runs with ~900MB of RAM and no swap. On 2026-09-07,
`mysqld` was killed mid-startup (during InnoDB initialization) by the Linux
kernel's OOM killer. systemd auto-restarted the service, which got
OOM-killed again immediately — this repeated 145 times in under a minute
until systemd's restart-rate limit kicked in and left `mysql.service` in a
permanent `failed` state. Nobody was using the instance at the time, so it
sat dead for about a month, unnoticed, until screenshots were needed for
this case study.

Confirmed via `dmesg` (`Out of memory: Killed process ... (mysqld)`) and
`journalctl -u mysql`, which showed the restart-counter climbing to its
limit (145) before systemd gave up.

Symptom at discovery: both phpMyAdmin and the app's own `dbConnect()`
failed identically with `mysqli_sql_exception: No such file or directory`
/ `HY000/2002` — a socket-connection failure, which is consistent with
MySQL simply not running rather than an application bug. The socket path
itself (`/var/run/mysqld/mysqld.sock`) matched on both the MySQL and PHP
sides the whole time; that wasn't the cause.

## Fix

- Added a 1GB swapfile (`/swapfile`, persisted via `/etc/fstab`) so a
  memory spike gets swap instead of a kill.
- Capped `innodb_buffer_pool_size` to 64M in
  `/etc/mysql/mysql.conf.d/mysqld.cnf` (was running on MySQL's default,
  too large for this box alongside nginx/php-fpm/snapd/ssm-agent).
- `systemctl reset-failed mysql` to clear the exhausted restart counter,
  then started the service.
- Verified: the CMS page renders real DB-driven content, phpMyAdmin loads
  clean, and the service stayed up under sustained load afterward with
  zero additional restarts.
