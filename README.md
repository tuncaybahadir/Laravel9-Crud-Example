# Laravel 9 Basic Crud App

## Installation

Install the dependencies and devDependencies and start the server.

## System Tools
Installation is explained according to linux systems.

| Tools | Version |
| ------ | ------ |
| Debian | 11 |
| Ubuntu | 20.04 LTS beetween 22.04 LTS |
| git | 2.x.x |
| nginx | 1.1x beetween 1.2x |
| mysql | 8 |
| php | 8.1 |
| composer | 2.3.x beetween 2.4.x |

> Note: `Package installations and settings are not included because they are separate issues.`

```sh
cd /var/www
git clone https://github.com/tuncaybahadir/Laravel9-Crud-Example.git
cd Laravel9-Crud-Example
composer install
composer run-script post-root-package-install
composer run-script post-create-project-cmd
nano .env
```
Edit the following fields on the cli according to your own server information. (You need to create the database for the project to work.)
```sh
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=xxxxx
DB_USERNAME=xxxxx
DB_PASSWORD=xxxxx
```

CTRL+x save and exit

```sh
php artisan migrate
```
For production environments...

## ready to fly

```sh
http://sampledomain.127.0.0.1.xip.io/person
```

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
