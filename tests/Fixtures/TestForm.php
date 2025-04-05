<?php

namespace Pixelpeter\FilamentLanguageTabs\Tests\Fixtures;

use Filament\Forms;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Livewire\Component;
use Pixelpeter\FilamentLanguageTabs\Forms\Components\LanguageTabs;

class TestForm extends Component implements HasForms
{
    use InteractsWithForms;

    public ?array $data = [];

    public function render(): string
    {
        return <<<'HTML'
        <div>{{ $this->form }}</div>
        HTML;
    }

    public function form(Form $form): Form
    {
        return $form
            ->statePath('data')
            ->schema([
                LanguageTabs::make([
                    Forms\Components\TextInput::make('headline')->label('headline')->required(),
                    Forms\Components\TextInput::make('slug')->label('slug'),
                    Forms\Components\MarkdownEditor::make('body')->label('body'),
                ]),
            ]);
    }
}
