# AGENTS.md

`tipctl` (TransIP Control) is a Symfony Console CLI that exposes the TransIP REST API (`https://api.transip.nl/v6`) as terminal commands. It wraps `transip/transip-api-php` and is mirrored to GitHub (`transip/tipctl`) and published on Packagist as `transip/tipctl`.

Repo type: neither backend nor frontend (CLI tool); this file follows the frontend section list minus what doesn't apply (no generated code).

## Tech stack

- PHP, `composer.json` requires `^7.2.5|^8.0`; `config.platform.php` is `8.2`, so `composer.lock` is resolved for PHP 8.2.
- `symfony/console`, `symfony/finder`, `symfony/filesystem`, `symfony/yaml` (`^5.4`), `symfony/cache`, `transip/transip-api-php` (`^6.54`).
- Dev tools: `php-parallel-lint`, `friendsofphp/php-cs-fixer` (`@PSR2` + short arrays), `phpstan/phpstan` 1.x (level 8, `src/` only), `rector/rector` 0.12.
- PHAR build: `humbug/box` with `box.json` (output `tipctl.phar`).

## Setup

```bash
composer config --global --auth http-basic.packeton.teamblue-ops.net token "$PACKETON_TOKEN"
composer install
php bin/tipctl --version
```

Real API calls need a config file created by `php bin/tipctl setup` (default `~/.config/transip-api/cli-config.json`, from `Settings::getDefaultConfigFilePath()`; override per command with `--configFile`). Without credentials, use the global `--demo` flag (TransIP demo account, needs internet access) to try read commands:

```bash
php bin/tipctl --demo vps:getall
php bin/tipctl --demo availabilityzones:getall --format=yaml
```

`--test` (`-t`) sets the API's test mode (dry run) for commands that change things.

- Team rules and procedures (commits, MRs, tests, generated code, workflows, releases) are agent skills in https://gitlab.group.team.blue/nl-transip/transip/ai-skills. If no `vps-*` skills are available to you, tell the developer to install them (see that repository's README) before you start; don't install them yourself.

## Commands

All of these run in the `lint` stage of `.gitlab-ci.yml` and pass on `master`:

```bash
./vendor/bin/parallel-lint --exclude vendor/ .                       # lint:php
./vendor/bin/php-cs-fixer fix -v --dry-run --using-cache=no          # lint:php-codestyle
./vendor/bin/phpstan --no-progress --memory-limit="2G"               # lint:php-stan
./vendor/bin/rector process --no-progress-bar --dry-run              # lint:rector
composer validate --no-interaction --strict                          # lint:composer
ci/scan_secrets.sh                                                   # lint:secretsscan
```

- `ci/scan_secrets.sh` runs `trufflehog --regex --entropy=True` over the whole git history (installs it with `pip` if missing); `.secretsignore` only excludes `composer.lock`. High-entropy strings in any committed file (including this one) get flagged.
- Drop `--dry-run` from `php-cs-fixer` / `rector` to apply fixes. Rector prints a deprecation warning about the `ContainerConfigurator` syntax in `rector.php`; it is harmless.

`build:phar` (stage `build`) builds the PHAR. To reproduce it, use a scratch clone because it installs without dev deps and edits `composer.json`/`composer.lock`:

```bash
composer global require humbug/box
composer install --no-dev --no-interaction --no-progress
composer require symfony/cache:^6.4
"$(composer global config bin-dir --absolute)"/box compile
php tipctl.phar --version
```

There is no PHPUnit suite; CI has no test job.

## Layout

| Path | What |
| --- | --- |
| `bin/tipctl` | Entry point: registers global `--demo`/`--test` options and auto-registers every instantiable `Command` subclass under `src/Command/` |
| `src/Command/` | One class per CLI command, grouped by resource (`Vps/`, `Domain/`, `BigStorage/`, `Haip/`, ...) |
| `src/Command/AbstractCommand.php` | Base class: adds `--format` and `--configFile`, builds `TransipAPI` in `initialize()`, provides `getTransipApi()`, `output()`, `warning()` |
| `src/Command/Field.php` | All argument/option names and help texts as constants |
| `src/Command/Setup/Setup.php` | `setup` command; writes the config file (skips API client creation in `AbstractCommand`) |
| `src/ConsoleOutput/` | `OutputFactory` plus `JsonOutput`, `YamlOutput`, `TxtOutput` (`txt` is `print_r`) |
| `src/Settings/Settings.php` | Config file loading, demo-mode settings, `TRANSIP_CLI_VERSION` |
| `src/Settings/Provider/Json.php` | Reads/writes the JSON config file |
| `ci/` | CI scripts: secrets scan, tag message and version checks, GitHub sync and release |
| `CHANGELOG.md` | One entry per released version |

## Conventions

- New command: add a class under `src/Command/<Resource>/` extending `AbstractCommand`. `bin/tipctl` finds it automatically; no registration list. The PSR-4 namespace (`Transip\Api\CLI\Command\...`) must match the path, because `bin/tipctl` builds the class name from the file path.
- Every file under `src/Command/` is loaded with `ReflectionClass`, so only put classes there.
- Command names are lowercase `resource[:subresource]:action`, e.g. `invoice:getall`, `vps:firewall:addrule`, `domain:dns:updatednsentry`.
- In `configure()`, use `Field` constants for names and help: `Field::X` with `Field::X__DESC`, append `Field::OPTIONAL` to the description of optional arguments (see `src/Command/Vps/CloneVps.php`). Add new constants to `Field.php`.
- In `execute()`, call the library via `$this->getTransipApi()->...`, print with `$this->output($data)` (respects `--format`) and return `0`. Example: `src/Command/Invoice/GetAll.php`.
- Long-running actions: `src/Command/Action/PollStatus.php` (`action:pollstatus`) polls `actions()->getByUuid()` until `Action::STATUS_FINISHED`.
- The lowest supported version is PHP 7.2: `rector.php` uses `LevelSetList::UP_TO_PHP_72` and `PhpVersion::PHP_72`. Existing code uses `@var` docblocks instead of typed properties.
- PHPStan runs at level 8 with no baseline.

## Releases

Releases are git tags `vX.Y.Z`. Tag pipelines run:
- `validate:tag-message`: the tag must have a non-empty message (`ci/validate_tag_message.sh`).
- `validate:tag-version-consistency`: `Settings::TRANSIP_CLI_VERSION` must equal the tag without `v` (`php ci/ValidateTagVersionConsistency.php v6.34.10`).
- `deploy:create-github-deploy` and `release:create-github-release`: push to GitHub `transip/tipctl` and upload `tipctl.phar`.

## Git / MRs

- Default branch: `master`. No staging/deploy branches; releases are tags.
- MRs are merged into `master` with a merge commit (`Merge branch '<branch>' into 'master'`).
