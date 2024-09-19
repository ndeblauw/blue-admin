# blue-admin, a custom admin backend

[![Latest Version on Packagist](https://img.shields.io/packagist/v/ndeblauw/blue-admin.svg?style=flat-square)](https://packagist.org/packages/ndeblauw/blue-admin)
[![Total Downloads](https://img.shields.io/packagist/dt/ndeblauw/blue-admin.svg?style=flat-square)](https://packagist.org/packages/ndeblauw/blue-admin)
![GitHub Actions](https://github.com/ndeblauw/blue-admin/actions/workflows/main.yml/badge.svg)

Documentation will follow once the pacakge becomes stable...

## Installation

You can install the package via composer:

```bash
composer require ndeblauw/blue-admin
```

Or manually add the following line to composer.json for the legacy version:
```
  "ndeblauw/blue-admin": "^1.0",
```
or for the newest version
```
  "ndeblauw/blue-admin": "9999999-dev",
```


## Usage
When using vite, don't forget to add to `tailwind.config.js`the following line
```js
export default {
    content: [
        // Existing paths
        './vendor/ndeblauw/blue-admin/resources/**/*.blade.php', // <-- ADD THIS
    ],
```


When using the Tinymceimage component, don't forget to add `blueadmin/tinymce/upload` to the $except list in the `\App\Http\Middleware\VerifyCsrfToken.php` middleware to make sure the image uploads will happen.

```php
protected $except = [
  'blueadmin/tinymce/upload', // add this line
];
```

### Testing

```bash
composer test
```

### Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

### Security

If you discover any security related issues, please email nico@bluepundit.eu instead of using the issue tracker.

## Credits

-   [Nico Deblauwe](https://github.com/ndeblauw)
-   [All Contributors](../../contributors)

## License

The GNU GPLv3. Please see [License File](LICENSE.md) for more information.

## Laravel Package Boilerplate

This package was generated using the [Laravel Package Boilerplate](https://laravelpackageboilerplate.com).
