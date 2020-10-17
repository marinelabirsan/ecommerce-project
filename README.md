# ebusiness project

## Requirements
* PHP
* [Composer](https://getcomposer.org/)
* [Node.js](https://nodejs.org/en/)
* NPM

## How to run

### Local dev

#### Copy the example .env and config it

``` cp .env.example .env ```

#### Install Laravel framework widh dependencies
``` composer install ```

#### Install Node dependencies
``` npm install ```

#### Migrate DB

``` php artisan migrate ```

#### Compile assets

``` npm run production ```

#### Run it in dev mode

``` php artisan serve --host 0.0.0.0 ```
