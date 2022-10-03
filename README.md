# Laravel Unité

[![Latest Version on Packagist](https://img.shields.io/packagist/v/theutz/laravel-unite.svg?style=flat-square)](https://packagist.org/packages/theutz/laravel-unite)
[![GitHub Tests Action Status](https://img.shields.io/github/workflow/status/theutz/laravel-unite/run-tests?label=tests)](https://github.com/theutz/laravel-unite/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/workflow/status/theutz/laravel-unite/Fix%20PHP%20code%20style%20issues?label=code%20style)](https://github.com/theutz/laravel-unite/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/theutz/laravel-unite.svg?style=flat-square)](https://packagist.org/packages/theutz/laravel-unite)

A unified toolkit for working with measurement units in Laravel

## Installation

You can install the package via composer:

```bash
composer require theutz/laravel-unite
```

You can publish and run the migrations with:

```bash
php artisan vendor:publish --tag="laravel-unite-migrations"
php artisan migrate
```

You can publish the config file with:

```bash
php artisan vendor:publish --tag="laravel-unite-config"
```

This is the contents of the published config file:

```php
return [
];
```

Optionally, you can publish the views using

```bash
php artisan vendor:publish --tag="laravel-unite-views"
```

## Usage

```php
$unite = new Theutz\Unite();
echo $unite->echoPhrase('Hello, Theutz!');
```

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Michael Utz](https://github.com/theutz)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
