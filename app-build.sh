npm run build

composer install --optimize-autoloader --no-dev

php artisan view:cache
php artisan event:cache
php artisan config:cache
