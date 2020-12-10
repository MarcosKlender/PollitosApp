![Platform](https://img.shields.io/badge/PLATFORM-Windows%20|%20Linux-important?style=for-the-badge)
# PollitosApp

Sistema desarrollado en Laravel 8.

## Requerimientos

- PHP >= 7.3.0
- BCMath PHP Extension
- Ctype PHP Extension
- JSON PHP Extension
- Mbstring PHP Extension
- OpenSSL PHP Extension
- PDO PHP Extension
- Tokenizer PHP Extension
- XML PHP Extension

## Instalación

- Descarga este repositorio con `git clone` e ingresa en el con `cd`
- Ejecuta el comando `composer install`
- Renombra el archivo `.env.example` como `.env`
- Ejecuta el comando `php artisan key:generate`
- Ingresa las credenciales de tu base de datos en el archivo `.env`
- Ejecuta el comando `php artisan migrate` para crear las tablas necesarias
- Ejecuta el comando `php artisan db:seed` para crear los roles de usuario
