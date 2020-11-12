# AppUpdater

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Total Downloads][ico-downloads]][link-downloads]

A package to handle updates distribution of mobile applications which are not published in the official stores.

## Installation

This package supports Laravel 7 and 8. 

Via Composer

``` bash
$ composer require egeatech/app-updater
```

## Usage

### Route registration

To use this package you simply have to register its routes. An example would be in your app `RouteServiceProvider`: 
just paste this in the `boot()` method
```php
EgeaTech\AppUpdater\Facades\AppUpdater::routes();
```
and you will be ready to go.

Optionally, you can define custom per-route middlewares or change the prefix of the routes defined by the package: 
simply pass to the `routes()` function a `EgeaTech\AppUpdater\Http\Routing\RoutingOptions` object defining your settings
of choice. An example usage is this:
```php
EgeaTech\AppUpdater\Facades\AppUpdater::routes(
    new EgeaTech\AppUpdater\Http\Routing\RoutingOptions([
        'middleware' => ['api'],
        'prefix' => 'api'
    ],[
        'client-credentials',
        'throttle:60,1',
        'my-custom-middleware-name',
    ])
);
```

### Configuration publishing

The package comes with a small configuration file which configures some little aspects. To publish it, run
```bash
 php artisan vendor:publish --tag app-updater.config
```

### Migrations publishing

The package will add an extra table to your database, to save all available applications. Publish its migration to get 
started by running
```bash
 php artisan vendor:publish --tag app-updater.migrations
```
NOTE: The published file can be modified but be aware that updating the structure will require to update the dependency 
injection defined by the package (more on this later).
 

### Dependency injection

The package is highly configurable, as most of its components are handled via interfaces wired by Laravel DI mechanism
to concrete classes. In order to override the components of the package (Form Requests, JSON resources, Eloquent Model, 
Service and Repository classes) you'll have to create a new `ServiceProvider` class to bind package own interface to 
your own custom class. In this example we'll reassign the `Application` model to another entity.

```php
class DependencyInjectionHandler extends ServiceProvider {
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        app()->bind(ApplicationModelContract::class, MyCustomApplication::class);
    }
}
```

After defining the new `ServiceProvider` class, don't forget to add it to your `config/app.php` file, in the `providers`
array.

## Change log

Please see the [changelog](changelog.md) for more information on what has changed recently.

## Contributing

Please see [contributing.md](contributing.md) for details.

## Security

If you discover any security related issues, please email author email instead of using the issue tracker.

## Credits

- [Egea Tecnologie Informatiche][link-author]
- [Marco Guidolin](mailto:m.guidolin@egeatech.com)

## License

The software is licensed under MIT. Please see the [license file](license.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/egeatech/app-updater.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/egeatech/app-updater.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/egeatech/app-updater
[link-downloads]: https://packagist.org/packages/egeatech/app-updater
[link-travis]: https://travis-ci.org/egeatech/app-updater
[link-author]: https://egeatech.com
