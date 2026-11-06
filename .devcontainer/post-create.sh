#!/bin/sh
set -eu

cd "$(dirname "$0")/.."

if [ ! -f composer.lock ]; then
    echo 'Initialization stopped: composer.lock is missing. Restore the tracked lockfile for your branch.' >&2
    exit 1
fi

if ! composer validate --strict; then
    echo 'Initialization stopped: Composer validation failed. Read the errors and warnings above.' >&2
    echo 'Fix the reported schema, metadata, or lockfile issue before retrying.' >&2
    echo 'See README.md: initialization troubleshooting. Dependencies were not updated.' >&2
    exit 1
fi

if ! composer check-platform-reqs --lock; then
    echo 'Initialization stopped: PHP or extension requirements from composer.lock are not met.' >&2
    echo 'Read the platform errors above. If using an old image, run Dev Containers: Rebuild Container.' >&2
    exit 1
fi

composer install --no-interaction --prefer-dist
composer check-platform-reqs
echo 'Initialization complete. Run composer test or composer check from the workspace root.'
