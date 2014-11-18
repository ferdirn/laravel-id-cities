# Laravel ID Cities

[![Total Downloads](https://poser.pugx.org/ferdirn/laravel-id-cities/downloads.svg)](https://packagist.org/packages/ferdirn/laravel-id-cities)
[![Latest Stable Version](https://poser.pugx.org/ferdirn/laravel-id-cities/v/stable.svg)](https://packagist.org/packages/ferdirn/laravel-id-cities)
[![Latest Unstable Version](https://poser.pugx.org/ferdirn/laravel-id-cities/v/unstable.svg)](https://packagist.org/packages/ferdirn/laravel-id-cities)

Laravel ID Cities is a package for Laravel to supply all cities data to table cities. Start from data cities in Indonesia.

If you need Laravel package to provide all Countries data for you, then you may want to install [ferdirn/laravel-id-countries](https://github.com/ferdirn/laravel-id-countries) package.

If you need Laravel package to provide all Provinces data for you, then you may want to install [ferdirn/laravel-id-provinces](https://github.com/ferdirn/laravel-id-provinces) package.


## Installation

Add `ferdirn/laravel-id-cities` to `composer.json`.

    "ferdirn/laravel-id-cities": "dev-master"

or in console type command

    composer require ferdirn/laravel-id-cities:dev-master

Run `composer update` to pull down the latest version of laravel packages.

Edit `app/config/app.php` file and add to `providers`

    'providers' => array(
        'Ferdirn\Cities\CitiesServiceProvider',
    )

also add to 'aliases'

    'aliases' => array(
        'Cities' => 'Ferdirn\Cities\CitiesFacade',
    )


## Model

If you want to edit the configuration then publish the config. This is an optional step and unrecommended to do, it will show the table name and you do not need to alter it if you do not know what you are doing. The default table name is `cities`, if it suits you, leave it. But if you know what you are doing, you can run the following command

    $ php artisan config:publish ferdirn/laravel-id-cities


Then you need to generate the migration file. Run the following command:

    $ php artisan cities:migration

This process will generate `<timestamp>_create_cities_table.php` migration file and a `CitiesSeeder.php` seed file.

Insert the following code in the `seeds/DatabaseSeeder.php`

    //Seed the cities
    $this->call('CitiesSeeder');
    $this->command->info('Seeded the cities!');

Finally, you can run the artisan migrate command with seed option to include the seed data:

    $ php artisan migrate --seed

Now you have a table 'cities' with all cities data inside the table. Congratulation!