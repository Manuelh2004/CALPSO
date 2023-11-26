<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

# FIRST ASSISTANT NO NAME YET

## Pasos para duplicar el proyecto

### Instalamos el proyecto, se generará la carpeta vendor
composer install

### Copiamos el .env.example para crear el archivo .env
cp .env.example .env

### Generamos la llave del proyecto
php artisan key:generate

### Generamos el acceso directo para los archivos
php artisan storage:link

### Corremos los migrations para generar la BD, la BD debe estar creada previamente
php artisan migrate:fresh --seed

### Generamos la llave JWT
php artisan jwt:secret

## Despues de ejecutar los migrate

php artisan db:seed --class=PSISSeeder
php artisan db:seed --class=PSIS_TIPOSeeder



