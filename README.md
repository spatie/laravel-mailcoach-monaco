# Mailcoach Monaco Editor

A Monaco editor package for Mailcoach
    
![](./docs/screenshot.png)

## Installation

You can install the package via composer:

```bash
composer require spatie/laravel-mailcoach-monaco
```

### Publish the assets

You must publish the JavaScript and CSS assets using this command:

```bash
php artisan vendor:publish --tag mailcoach-monaco-assets --force
```

## Usage

Set the `mailcoach.editor` config value to `\Spatie\MailcoachMonaco\MonacoEditor::class`

### Theme option

You can set the Monaco theme to either a light (default) or a dark theme, you can do this by adding a `mailcoach.monaco.theme` key to your `mailcoach.php` config file.

Available options: `vs-light`, `vs-dark`

```php
'monaco' => [
    'theme' => 'vs-light'
]
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security

If you discover any security related issues, please email freek@spatie.be instead of using the issue tracker.

## Credits

- [Rias Van der Veken](https://github.com/riasvdv)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
