<?php

namespace Pixelpeter\FilamentLanguageTabs\Tests\Fixtures;

use Filament\Schemas\Concerns\InteractsWithSchemas;
use Filament\Schemas\Contracts\HasSchemas;
use Filament\Schemas\Schema;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class FormTester extends Component implements HasSchemas
{
    use InteractsWithSchemas;

    public ?array $data = [];

    public function mount(): void
    {
        $this->form->fill();
    }

    public function form(Schema $schema): Schema
    {
        return TestForm::configure(
            $schema->statePath('data')
        );
    }

    public function render(): View
    {
        return view('filament-language-tabs::tests.support.testable-form');
    }
}
