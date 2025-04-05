<?php

use Pixelpeter\FilamentLanguageTabs\Tests\Fixtures\TestForm;

use function Pest\Livewire\livewire;

it('will add a field to the form', function ($field) {
    Config::set('filament-language-tabs', [
        'default_locales' => ['de', 'en', 'fr'],
        'required_locales' => [],
    ]);

    livewire(TestForm::class)->assertFormFieldExists($field);
})->with([
    'headline.de',
    'headline.en',
    'headline.fr',
    'body.de',
    'body.en',
    'body.fr',
]);

it('will set a field as required when given in required_locales', function ($field) {

    Config::set('filament-language-tabs', [
        'default_locales' => ['de', 'en', 'fr'],
        'required_locales' => ['de', 'en'],
    ]);

    livewire(TestForm::class)->assertFormFieldIsRequired($field);
})->with([
    'headline.de',
    'headline.en',
]);

it('will set a field as not required when not given in required_locales', function ($field) {
    Config::set('filament-language-tabs', [
        'default_locales' => ['de', 'en', 'fr'],
        'required_locales' => ['de', 'en'],
    ]);

    livewire(TestForm::class)->assertFormFieldIsNotRequired($field);
})->with([
    'headline.fr',
    'slug.de',
    'slug.en',
    'slug.fr',
    'body.de',
    'body.en',
    'body.fr',
]);
