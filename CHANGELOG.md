# Changelog

All notable changes to `filament-language-tabs` will be documented in this file.

## v5.0.0 - 2026-09-16

## Filament v5 support

This release adds support for Filament v5 and drops end-of-life Laravel and PHP versions. It is a major release only because of the narrowed support window — the plugin's public API is unchanged, so upgrading from the Filament 4.x line requires no code changes on your side.

### Added

- Support for Filament 5.x.
- Support for Laravel 13.x.
- Support for PHP 8.5.

### Removed

- Support for Filament 4.x, which continues on the `v4.x` branch and is released as `v4.0.0`.
- Support for Laravel 11.x, which reached end of life on 2026-03-12.
- Support for PHP 8.2. `pestphp/pest` v4 requires PHP 8.3, so the 8.2 test jobs could not install their dependencies.

### Changed

- Package requirements are now PHP `^8.3|^8.4|^8.5`, Laravel `12.*|13.*` and `filament/filament` plus `filament/schemas` `^5.0`.
- `orchestra/testbench` moved to `10.*|11.*`; `larastan`, `nunomaduro/collision` and `phpunit/phpunit` were narrowed to the versions that resolve alongside it.
- The test matrix now runs PHP 8.3, 8.4 and 8.5 against Laravel 12 and 13.
- The README documents the supported requirements and the branch-per-Filament-version mapping.
- Version numbering now follows the supported Filament major version, so this release is `v5.0.0`.

### Compatibility

| Filament | branch/tag |
|----------|------------|
| v5.x     | v5.x       |
| v4.x     | v4.x       |
| v3.x     | v2.x       |
| v2.x     | v1.x       |

From `v4.0.0` on, the plugin major version matches the Filament major version it supports. Earlier releases used a different scheme, where the plugin major trailed the Filament major by one.

### Notes

No changes were needed in the package source. Every Filament API the plugin uses — `Filament\Schemas\Components\Component`, `Tabs`, `Tab` and `Schema`, `Filament\Forms\Components\Hidden`, `InteractsWithForms`, `childComponents()` and `getChildComponentContainer()` — is unchanged in Filament 5.

Verified against PHP 8.3, 8.4 and 8.5 with both Laravel 12 and Laravel 13: 16 tests, 75 assertions passing, with PHPStan and Pint clean.

Thanks to @SkwirrelTom for the initial Filament v5 constraint bump in #26.

Closes #25.

## v4.0.0 - 2026-09-16

## Filament v4 support

This release renumbers the Filament 4.x line so that the plugin's major version matches the Filament major version it supports. The code is the `v3.0.0` release plus the CI and tooling updates merged since then; there are no source changes and no API changes, so `v3.0.0` users can move to `v4.0.0` without touching their code.

From this release on, the mapping is one to one: install `^4.0` for Filament 4.x and `^5.0` for Filament 5.x.

### Changed

- Version numbering now follows the supported Filament major version.
- Continued maintenance of the Filament 4.x line moves to the `v4.x` branch (previously `v3.x`).

### Compatibility

| Filament | branch/tag |
|----------|------------|
| v5.x     | v5.x       |
| v4.x     | v4.x       |
| v3.x     | v2.x       |
| v2.x     | v1.x       |

Releases before `v4.0.0` used a different scheme, where the plugin major trailed the Filament major by one: `v3.0.0` supports Filament 4.x, `v2.0.0` supports Filament 3.x and `v1.0.0` supports Filament 2.x. Those releases stay available and unchanged.

## v1.0.0 - 2025-04-02

Initial release for [Filament 2.x](https://github.com/filamentphp/filament/tree/2.x)

## 1.0.0 - 202X-XX-XX

- initial release
