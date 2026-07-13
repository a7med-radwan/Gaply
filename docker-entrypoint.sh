#!/bin/sh
set -e

# Dynamically set Apache port from Render's $PORT env variable (defaults to 80)
if [ -n "$PORT" ]; then
    echo "Setting Apache port to $PORT..."
    sed -i "s/Listen 80/Listen $PORT/g" /etc/apache2/ports.conf
    sed -i "s/<VirtualHost \*:80>/<VirtualHost *:$PORT>/g" /etc/apache2/sites-available/000-default.conf
fi

# Run optimization commands
echo "Caching Laravel configuration, routes, and views..."
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan event:cache

# Execute the main container command (which is apache2-foreground)
echo "Starting Apache..."
exec "$@"
