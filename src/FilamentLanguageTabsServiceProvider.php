<?php

namespace Pixelpeter\FilamentLanguageTabs;

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
}
