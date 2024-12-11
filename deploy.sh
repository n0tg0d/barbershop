#!/usr/bin/env bash

# Output a message indicating that the script is running
echo "Running composer"
# Run composer install to install dependencies (no-dev for production environment)
composer install --no-dev --working-dir=/var/www/html

# Output a message indicating config caching
echo "Caching config..."
# Cache the Laravel config files for optimization
php artisan config:cache

# Output a message indicating route caching
echo "Caching routes..."
# Cache the Laravel routes to improve performance
php artisan route:cache

# Output a message indicating migrations are running
echo "Running migrations..."
# Run database migrations, the --force flag is required to run migrations in production
php artisan migrate --force

# End of script
echo "Deployment complete!"
