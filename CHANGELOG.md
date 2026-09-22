# Changelog

All notable changes to `filament-language-tabs` will be documented in this file.

## v4.0.1 - 2026-09-22

Maintenance release for the Filament 4.x line. No functional or API changes — `src/` is untouched since `v4.0.0`.

### Why this release exists

`v4.0.0` was published to Packagist from the wrong commit: the tag was originally created on the Filament 5 commit, indexed by Packagist, and then moved. Packagist treats an indexed version's commit as immutable, so it kept serving a `v4.0.0` that required `filament/filament: ^5.0`. That made `composer require pixelpeter/filament-language-tabs:^4.0` unusable on Filament 4.

The broken `v4.0.0` record has been deleted from Packagist. This release republishes the Filament 4 line from the `v4.x` branch head, where `composer.json` correctly requires `filament/filament: ^4.0`.

### CI fixes on the v4.x line

This line had drifted eight commits behind `main` and received no dependency updates at all, because Dependabot reads its config only from the default branch.

- Restrict the code style workflow to branch pushes and fall back to `github.ref_name`. It previously used `github.head_ref`, which is empty on a tag push, leaving a detached HEAD and failing with `fatal: You are not currently on a branch.`
- Point the changelog workflow's checkout and commit at `v4.x`. It was hardcoded to `main`, so a release from this line would have written its entry onto the Filament 5 line and been rejected by branch protection with `GH006`.
- Run the test suite on `v4.x`. Both trigger filters were set to `branches: [ main ]`, so no push or pull request on this line had ever run the tests.
- Do not pass `CHANGELOG_TOKEN` on this branch. `actions/checkout` persists credentials into `.git/config` for later steps, and `v4.x` has no branch protection, so the default `GITHUB_TOKEN` suffices.
- Bump `actions/checkout` 6 → 7, `ramsey/composer-install` 3 → 4, `dependabot/fetch-metadata` 2.5.0 → 3.1.0.

Dependabot now targets `v4.x` as well as `main`, so this line will keep itself current.

### Upgrading

No action required. `composer require pixelpeter/filament-language-tabs:^4.0` now resolves correctly on Filament 4.

## v1.0.0 - 2025-04-02

Initial release for [Filament 2.x](https://github.com/filamentphp/filament/tree/2.x)

## 1.0.0 - 202X-XX-XX

- initial release
