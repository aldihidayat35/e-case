@echo off
REM E-Case System - Optimization Script for Windows

echo Starting E-Case Optimization...
echo.

REM Clear all caches
echo Clearing caches...
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear
echo.

REM Optimize application
echo Optimizing application...
php artisan config:cache
php artisan route:cache
php artisan view:cache
echo.

REM Optimize composer autoloader
echo Optimizing composer autoloader...
composer dump-autoload -o
echo.

echo Optimization complete!
echo.
echo Your application is now optimized for better performance.
echo Access your application at: http://localhost/e-case
echo.
pause
