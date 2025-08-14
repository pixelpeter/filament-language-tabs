<?php

// tests/TestCase.php

namespace Pixelpeter\FilamentLanguageTabs\Tests;

use Filament\Facades\Filament;
use Filament\FilamentServiceProvider;
use Filament\Forms\FormsServiceProvider;
use Filament\Schemas\SchemasServiceProvider;
use Filament\Support\SupportServiceProvider;
use Illuminate\Support\MessageBag;
use Illuminate\Support\ViewErrorBag;
use Livewire\LivewireServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;
use Pixelpeter\FilamentLanguageTabs\FilamentLanguageTabsServiceProvider;

abstract class TestCase extends Orchestra
{
    protected function getPackageProviders($app): array
    {
        // Order matters a bit:
        // Support -> Schemas -> Filament -> Forms -> Livewire
        return [
            SupportServiceProvider::class,
            SchemasServiceProvider::class,
            FilamentServiceProvider::class,
            FormsServiceProvider::class,
            LivewireServiceProvider::class,
            FilamentLanguageTabsServiceProvider::class,
        ];
    }

    protected function setUp(): void
    {
        parent::setUp();

        $errors = new ViewErrorBag;
        $errors->put('default', new MessageBag);
    }
}
