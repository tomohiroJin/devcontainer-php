#!/bin/sh
set -eu

cd "$(dirname "$0")/.."

if ! php -r 'exit(PHP_VERSION_ID >= 80500 && PHP_VERSION_ID < 80600 ? 0 : 1);'; then
    echo 'PHP 8.5 is required. Run Dev Containers: Rebuild Container after switching branches.' >&2
    exit 1
fi

if [ ! -f composer.lock ]; then
    echo 'Initialization stopped: composer.lock is missing. Restore the tracked lockfile for your branch.' >&2
    exit 1
fi

if ! composer validate --strict; then
    echo 'Initialization stopped: composer.json and composer.lock must belong to the same checkout.' >&2
    echo 'Back up any local lockfile, restore the tracked files for your branch, and retry.' >&2
    echo 'See README.md: initialization troubleshooting. Dependencies were not updated.' >&2
    exit 1
fi

composer install --no-interaction --prefer-dist
composer check-platform-reqs
echo 'Initialization complete. Run composer test or composer check from the workspace root.'
