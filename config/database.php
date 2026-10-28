<?php

declare(strict_types=1);

/**
 * Database configuration.
 *
 * Values come from the environment (see `.env.example`); real credentials
 * never belong in this file or in source control. The `password` key path is
 * recognised by the redactor, so `config:show database` prints `[redacted]`
 * instead of the secret.
 *
 * Drivers: `mysql` (needs `pdo_mysql`) and `pgsql` (needs `pdo_pgsql`).
 * Both are gated by integration tests — see the README "Database setup".
 */

$driver = (string) env('DB_DRIVER', 'mysql');

return [
    'driver' => $driver,
    'host' => (string) env('DB_HOST', '127.0.0.1'),
    'port' => (int) env('DB_PORT', $driver === 'pgsql' ? 5432 : 3306),
    'database' => (string) env('DB_DATABASE', 'sahil'),
    'username' => (string) env('DB_USERNAME', ''),
    'password' => (string) env('DB_PASSWORD', ''),
    'charset' => (string) env('DB_CHARSET', 'utf8mb4'),

    // Where migrations and seeders live, relative to the application base path.
    'migrations' => 'database/migrations',
    'seeders' => 'database/seeders',

    // Advisory-lock name for migration runs. MySQL's GET_LOCK namespace is
    // global to the server, so the database name is appended at runtime to
    // keep separate databases independent; PostgreSQL advisory locks are
    // already per-database.
    'lock' => 'sahil_migrations',
    'lock_timeout' => 10,
];
