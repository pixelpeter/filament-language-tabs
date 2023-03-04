<?php

namespace Pixelpeter\FilamentLanguageTabs;

use Filament\PluginServiceProvider;
use Illuminate\Filesystem\Filesystem;
use Livewire\Testing\TestableLivewire;
use Pixelpeter\FilamentLanguageTabs\Forms\Testing\TestsForms;
use Spatie\LaravelPackageTools\Package;

class FilamentLanguageTabsServiceProvider extends PluginServiceProvider
{
    public static string $name = 'filament-language-tabs';

    public function configurePackage(Package $package): void
    {
        $package->name(static::$name)
            ->hasConfigFile()
            ->hasViews('filament-language-tabs');
    }

    public function packageBooted(): void
    {
        TestableLivewire::mixin(new TestsForms());
    }
}
