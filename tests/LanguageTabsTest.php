<?php

use Illuminate\Support\Facades\Config;
use Livewire\Livewire;
use Pixelpeter\FilamentLanguageTabs\Forms\Components\LanguageTabs;
use Filament\Forms;
use Filament\Resources\Form;
use Pixelpeter\FilamentLanguageTabs\Tests\Support\TestableForm;

it('will add a field to the form', function ($field) {
    Config::set('filament-language-tabs', [
        'default_locales' => ['de', 'en', 'fr'],
        'required_locales' => [],
    ]);

    $form = TestableForm::$formSchema = [
        LanguageTabs::make()
            ->schema([
                Forms\Components\TextInput::make('headline')->label('headline')->required(),
                Forms\Components\TextInput::make('slug')->label('slug'),
                Forms\Components\MarkdownEditor::make('body')->label('body'),
            ])
    ];

    $component = Livewire::test(TestableForm::class);

    $component->assertFormFieldExists($field);
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

    $form = TestableForm::$formSchema = [
        LanguageTabs::make()
            ->schema([
                Forms\Components\TextInput::make('headline')->label('headline')->required(),
                Forms\Components\TextInput::make('slug')->label('slug'),
                Forms\Components\MarkdownEditor::make('body')->label('body'),
            ])
    ];

    $component = Livewire::test(TestableForm::class);

    $component->assertFormFieldIsRequired($field);
})->with([
    'headline.de',
    'headline.en',
]);

it('will set a field as not required when not given in required_locales', function ($field) {
    Config::set('filament-language-tabs', [
        'default_locales' => ['de', 'en', 'fr'],
        'required_locales' => ['de', 'en'],
    ]);

    $form = TestableForm::$formSchema = [
        LanguageTabs::make()
            ->schema([
                Forms\Components\TextInput::make('headline')->label('headline')->required(),
                Forms\Components\TextInput::make('slug')->label('slug'),
                Forms\Components\MarkdownEditor::make('body')->label('body'),
            ])
    ];

    $component = Livewire::test(TestableForm::class);

    $component->assertFormFieldIsNotRequired($field);
})->with([
    'headline.fr',
    'slug.de',
    'slug.en',
    'slug.fr',
    'body.de',
    'body.en',
    'body.fr',
]);
