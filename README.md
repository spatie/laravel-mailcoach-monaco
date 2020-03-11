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

Every time the package is updated you'll need to run that command. You can automate this by adding it to your `post-update-cmd` script in `composer.json`.

```
"scripts": {
    "post-update-cmd": [
        "@php artisan vendor:publish --tag mailcoach-monaco-assets --force"
    ]
}
```

## Usage

Set the `mailcoach.editor` config value to `\Spatie\MailcoachMonaco\MonacoEditor::class`

### Options

You can change some Monaco editor options by adding a `monaco` configuration key to your `mailcoach.php` config file.

```php
'monaco' => [
    'theme' => 'vs-light', // vs-light or vs-dark
    'fontFamily' => 'Jetbrains Mono',
    'fontLigatures' => true,
    'fontWeight' => 400,
    'fontSize' => '16', // No units
    'lineHeight' => '24' // No units
],
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
