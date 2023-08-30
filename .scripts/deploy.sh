#!/bin/bash
set -e

echo "Deployment started ..."
if [ ! -f "vendor/autoload.php" ]; then
    composer install --no-progress --no-interaction
fi

if [ ! -f ".env" ]; then
    echo "Creating env file for env $APP_ENV"
    cp .env.staging .env
else
    echo "env file exists."
fi
# Enter maintenance mode or return true
# if already is in maintenance mode
(php artisan down) || true

# Pull the latest version of the app
git pull origin staging

# Install composer dependencies
# composer install --no-dev --no-interaction --prefer-dist --optimize-autoloader

# Clear the old cache
php artisan clear-compiled

# Recreate cache
php artisan optimize

# Compile npm assets
# npm run prod

# Run database migrations
# php artisan migrate --force
php artisan migrate --force --env=staging --pretend

# Exit maintenance mode
php artisan up

echo "Deployment finished!"