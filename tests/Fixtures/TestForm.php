<?php

namespace Pixelpeter\FilamentLanguageTabs\Tests\Fixtures;

use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Pixelpeter\FilamentLanguageTabs\Forms\Components\LanguageTabs;

class TestForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                LanguageTabs::make([
                    TextInput::make('headline')->label('headline')->required(),
                    TextInput::make('slug')->label('slug'),
                    MarkdownEditor::make('body')->label('body'),
                ]),
            ]);
    }
}
