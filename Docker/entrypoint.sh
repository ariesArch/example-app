# #!/bin/bash

# #!/bin/bash

# if [ ! -f "vendor/autoload.php" ]; then
#     composer install --no-progress --no-interaction
# fi

# if [ ! -f ".env" ]; then
#     echo "Creating env file for env $APP_ENV"
#     cp .env .env
# else
#     echo "env file exists."
# fi
# php artisan migrate
# php artisan key:generate
# php artisan cache:clear
# php artisan config:clear
# php artisan route:clear
# php artisan serve --port=$PORT --host=0.0.0.0 --env=.env
# exec docker-php-entrypoint "$@"
# php-fpm -D
# nginx -g "daemon off;"

#!/bin/bash

if [ ! -f "vendor/autoload.php" ]; then
    composer install --no-progress --no-interaction
fi

if [ -z "$APP_ENV" ]; then
    echo "APP_ENV is not set. Please set the APP_ENV environment variable."
    exit 1
fi

if [ "$APP_ENV" = "staging" ]; then
    ENV_FILE=".env.staging"
elif [ "$APP_ENV" = "production" ]; then
    ENV_FILE=".env.production"
else
    echo "Unknown APP_ENV: $APP_ENV"
    ENV_FILE=".env"
fi

if [ ! -f ".env" ]; then
    echo "Creating env file for env $APP_ENV"
    cp "$ENV_FILE"  .env
else
    echo "env file exists."
fi

php artisan migrate
php artisan optimize
php artisan view:cache

php-fpm -D
nginx -g "daemon off;"