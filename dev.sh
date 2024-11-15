composer install
cp .env.example .env
php artisan key:generate
php artisan optimize:clear

# Hapus dan buat ulang folder storage pada public
rm -rf public/storage
php artisan storage:link

# Install paket npm
npm install