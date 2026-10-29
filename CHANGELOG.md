# Changelog

All notable changes to `sahilphp/starter-kit` are documented here.
The format follows [Keep a Changelog](https://keepachangelog.com/en/1.1.0/)
and this project adheres to [Semantic Versioning](https://semver.org/).

## [Unreleased]

## [1.0.0]

### Fixed
- Enforced PHP 8.4 minimum version requirement in composer.json, tooling, and code

## Unreleased - 2026-10-29

First public release.

### Added

- `php bin/sahil key:generate` — writes a 32-byte `APP_KEY` to `.env`
  (`--force` replaces an existing key).
- `php bin/sahil storage:prepare` — creates the writable storage tree.
- `composer create-project` hooks that copy `.env.example` to `.env`,
  generate the app key and prepare storage in one step.
- `App\Providers\EncryptionProvider` binding `Sahil\Encryption\Encrypter`
  from `APP_KEY`.
- Secure response headers from `Sahil\Http\Middleware\SecurityHeaders`,
  installed by `ObservabilityProvider` for every request.
- `queue.allowed_jobs` configuration for a queue-payload class allow-list.
- Deployment examples: `docs/deploy/nginx.conf.example`,
  `docs/deploy/apache-vhost.conf.example`, `public/.htaccess` and a static
  `public/500.html` server-level error page.
- `TESTING.md` guidance is in `README.md`; `CONTRIBUTING.md`, `SECURITY.md`
  and `CODE_OF_CONDUCT.md` are included.

### Changed

- Requires `sahilphp/framework: ^1.0` and PHP 8.4+ (was `^8.4` with a
  `path` repository and `^1.0@dev`).
- `Throttle` is constructed with an explicit store, matching the framework.
- PHPUnit moved to `^10.5`.

### Removed

- The committed `composer.lock` (a project template resolves dependencies at
  create time) and the local `path` repository used during development.

### Fixed

- `.env.example` documents `APP_KEY`, which the new commands write and the
  encrypter reads.
