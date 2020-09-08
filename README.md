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
chmod -R 777 database
chmod -R 777 storage
php artisan migrate
php artisan serve --port=9000
```

## Symfony
#### Setup
```
cd code-symfony
cp .env.test .env
composer install
php bin/console doctrine:database:create
chmod -R 777 var
php bin/console doctrine:schema:create
```

## Docker
#### Setup
```
docker build -t php-base php/
docker build -t nginx-base nginx/
```

## Running Applications
#### Laravel
```
docker-compose -f ./docker-compose.laravel.yml up
```
App can be accessed at http://localhost:8000

#### Symfony
```
docker-compose -f ./docker-compose.symfony.yml up
```
App can be accessed at http://localhost:8000