release: cp laravel-cloud-env.txt .env && touch /tmp/database.sqlite && php artisan key:generate --force && php artisan config:cache
web: vendor/bin/heroku-php-nginx
