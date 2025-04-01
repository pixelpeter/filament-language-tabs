# Group multilingual fields into tabs

[![Latest Version on Packagist](https://img.shields.io/packagist/v/pixelpeter/filament-language-tabs.svg?style=flat-square&t=123)](https://packagist.org/packages/pixelpeter/filament-language-tabs)
[![Total Downloads](https://img.shields.io/packagist/dt/pixelpeter/filament-language-tabs.svg?style=flat-square)](https://packagist.org/packages/pixelpeter/filament-language-tabs)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE.md)
[![Coverage Status](https://coveralls.io/repos/github/pixelpeter/filament-language-tabs/badge.svg?branch=master)](https://coveralls.io/github/pixelpeter/filament-language-tabs?branch=master)
[![Tests](https://github.com/pixelpeter/filament-language-tabs/actions/workflows/run-tests.yml/badge.svg?branch=master)](https://github.com/pixelpeter/filament-language-tabs/actions/workflows/run-tests.yml)
[![Fix PHP code style issues](https://github.com/pixelpeter/filament-language-tabs/actions/workflows/fix-php-code-style-issues.yml/badge.svg)](https://github.com/pixelpeter/filament-language-tabs/actions/workflows/fix-php-code-style-issues.yml)
[![PHPStan](https://github.com/pixelpeter/filament-language-tabs/actions/workflows/phpstan.yml/badge.svg)](https://github.com/pixelpeter/filament-language-tabs/actions/workflows/phpstan.yml)
[![dependabot-auto-merge](https://github.com/pixelpeter/filament-language-tabs/actions/workflows/dependabot-auto-merge.yml/badge.svg)](https://github.com/pixelpeter/filament-language-tabs/actions/workflows/dependabot-auto-merge.yml)

This package is a Filament plugin that allows you to group multilingual fields into tabs
![](images/filament-language-tabs-example.de.png)

## Installation

You can install the package via composer:

```bash
composer require pixelpeter/filament-language-tabs
```

You can publish the config file with:

```bash
php artisan vendor:publish --tag="filament-language-tabs-config"
```

Optionally, you can publish the views using

```bash
php artisan vendor:publish --tag="filament-language-tabs-views"
```

This is the contents of the published config file:

```php
return [
    /*
    |--------------------------------------------------------------------------
    | Default Locales
    |--------------------------------------------------------------------------
    |
    | These are the locales this package will use generate the tabs
    |
    */
    'default_locales' => ['de', 'en', 'fr'],
    /*
    |--------------------------------------------------------------------------
    | Required Locales
    |--------------------------------------------------------------------------
    |
    | These are the locales this package will use to set the field as required
    | This can be used if one translation or language is optional
    |
    */
    'required_locales' => ['de', 'en'],
];
```

## Usage

### Prerequisites

#### Install spatie-translatable

```bash
composer require spatie/laravel-translatable
```

#### Make the model for translations

```php
// Models/Post.php
class Post extends Model
{
    use HasFactory, HasTranslations;

    public $translatable = ['headline', 'body', 'slug'];

    protected $casts = [
        'headline' => 'array',
        'body' => 'array',
        'slug' => 'array',
    ];

    protected $guarded = ['id'];
}

// database/migrations
...    
public function up(): void
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->json('headline');
            $table->json('slug');
            $table->json('body');
            $table->timestamps();
        });
    }
...
```

### Setup & configuration

#### Add the LanguageTabs component to your Filament resource

```php
// app/Filament/Resources/PostResource.php
...
use Pixelpeter\FilamentLanguageTabs\Forms\Components\LanguageTabs;

class PostResource extends Resource
{
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Grid::make(1)
                    ->schema([
                        LanguageTabs::make($form)
                            ->schema([
                                Forms\Components\TextInput::make('headline')->label('headline')->required(),
                                Forms\Components\TextInput::make('slug')->label('slug'),
                                Forms\Components\MarkdownEditor::make('body')->label('body'),
                            ]),

                    ]),
            ]);
    }
```

#### Configure which languages to add to the tabs

```php 
// config/filament-language-tabs.php
return [
    'default_locales' => ['de', 'en', 'fr'],
]
```

#### Configure for which languages a field is required

If a field is defined as `required`

```php 
...
->schema([
    Forms\Components\TextInput::make('headline')->label('headline')->required(),
    ...
]),    
...
```

it will only be set as required for the languages configure as `required_locals`

```php
// config/filament-language-tabs.php
return [
    'required_locales' => ['de', 'en'],
]
```

![](images/filament-language-tabs-example.fr.png)
*The `headline` is not (marked as) required for French language*

## Testing

```bash
./vendor/bin/pest
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](.github/CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [pixelpeter](https://github.com/pixelpeter)
- Thanks to [ralphjsmit](https://github.com/ralphjsmit) for the inspiration of creating
  a [TestableForm](https://github.com/ralphjsmit/laravel-filament-components/blob/main/tests/Support/TestableForm.php)
  to help with testing this component
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
