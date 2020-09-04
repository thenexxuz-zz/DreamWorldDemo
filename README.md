# DreamWorldDemo

## Laravel
#### Setup 
```
cd code-laravel
cp .env.example .env
composer install
yarn
yarn dev
touch database/database.sqlite
chmod 777 database/database.sqlite
chmod 777 database
chmod -R 777 storage
php artisan migrate
cd ..
docker build -t php-base php/
docker build -t nginx-base nginx/
docker-compose up
```

## Symfony
#### Setup
```
Not completed
```