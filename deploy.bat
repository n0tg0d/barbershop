@echo off
REM Running Composer Install
echo Running composer...
php composer.phar install --no-dev --working-dir=F:/CODING PRACTITCE/task/barber-app

REM Caching Config
echo Caching config...
php artisan config:cache

REM Caching Routes
echo Caching routes...
php artisan route:cache

REM Running Migrations
echo Running migrations...
php artisan migrate --force

echo Deployment complete!
