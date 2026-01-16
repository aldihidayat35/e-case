#!/bin/bash
# E-Case System - Optimization Script

echo "🚀 Starting E-Case Optimization..."

# Clear all caches
echo "📦 Clearing caches..."
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear

# Optimize application
echo "⚡ Optimizing application..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Optimize composer autoloader
echo "📚 Optimizing composer autoloader..."
composer dump-autoload -o

echo "✅ Optimization complete!"
echo ""
echo "📊 Your application is now optimized for better performance."
echo "🌐 Access your application at: http://localhost/e-case"
