@echo off
echo Installing Composer dependencies...
composer install --no-dev --optimize-autoloader

echo Clearing caches...
php artisan config:cache
php artisan route:cache
php artisan view:cache

echo Setting storage permissions...
icacls storage /grant "IIS_IUSRS:(OI)(CI)F"
icacls bootstrap/cache /grant "IIS_IUSRS:(OI)(CI)F"

echo Build script completed.
