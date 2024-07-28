composer install

cp .env.example .env

php artisan key:generate
php artisan optimize:clear
php artisan storage:link

npm ci
