#!/usr/bin/env sh
set -eu

export PORT="${PORT:-10000}"

if [ -z "${DB_URL:-}" ] && [ -n "${DATABASE_URL:-}" ]; then
    export DB_URL="$DATABASE_URL"
fi

if [ -z "${DB_CONNECTION:-}" ] && [ -n "${MYSQL_ADDON_URI:-}" ]; then
    export DB_CONNECTION=mysql
fi

if [ -z "${DB_HOST:-}" ] && [ -n "${MYSQL_ADDON_HOST:-}" ]; then
    export DB_HOST="$MYSQL_ADDON_HOST"
fi

if [ -z "${DB_PORT:-}" ] && [ -n "${MYSQL_ADDON_PORT:-}" ]; then
    export DB_PORT="$MYSQL_ADDON_PORT"
fi

if [ -z "${DB_DATABASE:-}" ] && [ -n "${MYSQL_ADDON_DB:-}" ]; then
    export DB_DATABASE="$MYSQL_ADDON_DB"
fi

if [ -z "${DB_USERNAME:-}" ] && [ -n "${MYSQL_ADDON_USER:-}" ]; then
    export DB_USERNAME="$MYSQL_ADDON_USER"
fi

if [ -z "${DB_PASSWORD:-}" ] && [ -n "${MYSQL_ADDON_PASSWORD:-}" ]; then
    export DB_PASSWORD="$MYSQL_ADDON_PASSWORD"
fi

sed -ri "s/^Listen .*/Listen ${PORT}/" /etc/apache2/ports.conf
sed -ri "s/<VirtualHost \*:[0-9]+>/<VirtualHost *:${PORT}>/" /etc/apache2/sites-available/000-default.conf

mkdir -p \
    storage/app/public \
    storage/framework/cache \
    storage/framework/sessions \
    storage/framework/views \
    storage/logs \
    bootstrap/cache

chown -R www-data:www-data storage bootstrap/cache

php artisan optimize:clear
php artisan config:cache
php artisan route:cache
php artisan view:cache

if [ "${RUN_MIGRATIONS:-true}" = "true" ]; then
    php artisan migrate --force
fi

exec apache2-foreground
