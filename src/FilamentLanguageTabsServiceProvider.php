<?php

namespace Pixelpeter\FilamentLanguageTabs;

use Livewire\Features\SupportTesting\Testable;
use Pixelpeter\FilamentLanguageTabs\Forms\Testing\LivewireCustomAssertionsMixin;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;


class FilamentLanguageTabsServiceProvider extends PackageServiceProvider
{
    public static string $name = 'filament-language-tabs';

    public function configurePackage(Package $package): void
    {
        $package->name(static::$name)
            ->hasConfigFile()
            ->hasViews();
    }

    public function bootingPackage(): void
    {
        Testable::mixin(new LivewireCustomAssertionsMixin());
    }
}
