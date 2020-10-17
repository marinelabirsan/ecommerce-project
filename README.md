# ebusiness project

## Requirements
* PHP
* [Composer](https://getcomposer.org/)
* NPM

## How to run

### Local dev

#### Copy the example .env and config it

``` cp .env.example .env ```

#### Install dependencies
``` composer install ```
``` npm install ```

#### Migrate DB

``` php artisan migrate ```

#### Compile assets

``` npm run production ```

#### Run it in dev mode

``` php artisan serve --host 0.0.0.0 ```
