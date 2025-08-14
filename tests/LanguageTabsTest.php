<?php

namespace Pixelpeter\FilamentLanguageTabs\Tests;

use Illuminate\Support\Facades\Config;
use Pixelpeter\FilamentLanguageTabs\Tests\Fixtures\FormTester;

use function Pest\Livewire\livewire;

it('will add a field to the form', function ($field) {
    Config::set('filament-language-tabs', [
        'default_locales' => ['de', 'en', 'fr'],
        'required_locales' => [],
    ]);

    $locale = explode('.', $field)[1];
    $component = "language_tabs.tab_{$locale}.{$field}";

    livewire(FormTester::class)
        ->assertFormExists('form')
        ->assertSchemaComponentExists($component);
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

    $locale = explode('.', $field)[1];
    $component = "language_tabs.tab_{$locale}.{$field}";

    livewire(FormTester::class)
        ->assertFormExists('form')
        ->assertSchemaComponentExists($component)
        ->assertFormFieldExists("language_tabs.tab_{$locale}.{$field}", function ($field) {
            return $field->isRequired();
        });

})->with([
    'headline.de',
    'headline.en',
]);

it('will set a field as not required when not given in required_locales', function ($field) {
    Config::set('filament-language-tabs', [
        'default_locales' => ['de', 'en', 'fr'],
        'required_locales' => ['de', 'en'],
    ]);

    $locale = explode('.', $field)[1];
    $component = "language_tabs.tab_{$locale}.{$field}";

    livewire(FormTester::class)
        ->assertFormExists('form')
        ->assertSchemaComponentExists($component)
        ->assertFormFieldExists("language_tabs.tab_{$locale}.{$field}", function ($field) {
            return ! $field->isRequired();
        });
})->with([
    'headline.fr',
    'slug.de',
    'slug.en',
    'slug.fr',
    'body.de',
    'body.en',
    'body.fr',
]);
