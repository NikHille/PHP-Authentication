# PHP Authentication Webapp

A showcase webapp that allows you to sign up and sign in, so you can access otherwise inaccessible content.


## Get Started

This project uses PHP and composer. Both are required to run this webapp.

Install all [dependencies](#dependencies) using composer:

```cmd
composer install
```

For development you can start a webserver using the native php command:

```cmd
php -S 127.0.0.1:8000 -t src/www
```


## User Management

For a faster setup of this project a json is used for the user management instead of a database system. The user data is stored with an auto-incrementing index, where the user email and password hash are stored as objects.

A database should be used for production!


## Unit Tests

Unit tests are written with PHPUnit and can be started with:

```cmd
./vendor/bin/phpunit
```

or use the composer script.

```cmd
composer run-script test
```


## Dependencies

Following dependencies are being used:

- PHPUnit