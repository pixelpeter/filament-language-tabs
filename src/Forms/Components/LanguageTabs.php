<?php

namespace Pixelpeter\FilamentLanguageTabs\Forms\Components;

use Filament\Forms;
use Filament\Forms\Components\Tabs;
use Filament\Resources\Form;

final class LanguageTabs
{
    public function __construct(
        public Form $form,
    ) {
    }

    public function schema(array $components): Tabs
    {
        $locales = config('filament-language-tabs.default_locales');
        $locales = array_unique($locales);

        $tabs = [];
        foreach ($locales as $locale) {
            $tabs[] = Forms\Components\Tabs\Tab::make(strtoupper($locale))
                ->schema(
                    $this->tabfields($components, $locale)
                );
        }

        return Forms\Components\Tabs::make('LanguageTabs')
            ->schema(
                $tabs
            );
    }

    public static function make(Form $form = null): static
    {
        if (! $form) {
            $form = Form::make();
        }

        return new static(form: $form);
    }

    protected function tabfields(array $components, string $locale): array
    {
        $required_locales = config('filament-language-tabs.required_locales');
        $required_locales = array_unique($required_locales);

        $tabfields = [];
        foreach ($components as $component) {
            $clone = clone $component;
            $name = $clone->getName().'.'.$locale;
            $clone->name($name);
            $clone->statePath($name);

            if (in_array($locale, $required_locales) && $component->isRequired()) {
                $clone->required(true);
            } else {
                $clone->required(false);
            }

            $tabfields[] = $clone;
        }

        return $tabfields;
    }
}
