#!/bin/sh
set -e

echo "Deploying application ..."

# Enter maintenance mode
#(php artisan down --message 'The app is being (quickly!) updated. Please try again in a minute.') || true
    # Update codebase
    git pull origin dev
    #git reset --hard origin/main

    # Install dependencies based on lock file
    /usr/local/bin/composer install --no-interaction --prefer-dist --optimize-autoloader

    # Migrate database
    php artisan migrate --force

    # Note: If you're using queue workers, this is the place to restart them.
    # ...

    # Clear cache
    #php artisan optimize

    # Reload PHP to update opcache
    echo "" | sudo -S service php-fpm reload
# Exit maintenance mode
php artisan up

echo "Application deployed!"
