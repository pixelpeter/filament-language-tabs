<?php

namespace Pixelpeter\FilamentLanguageTabs\Forms\Components;

use Closure;
use Filament\Forms\Components\Component;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Tabs\Tab;
use Filament\Forms\Concerns\BelongsToParentComponent;
use Filament\Forms\Concerns\HasComponents;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Form;

class LanguageTabs extends Component
{
    use BelongsToParentComponent;
    use HasComponents;
    use InteractsWithForms;

    /**
     * @var view-string
     */
    /** @phpstan-ignore-next-line */
    protected string $view = 'filament-language-tabs::forms.components.language-tabs';

    final public function __construct(array|Closure $schema)
    {
        $this->schema($schema);
    }

    public function schema(Closure|Form|array $components): static
    {
        $locales = config('filament-language-tabs.default_locales');
        $locales = array_unique($locales);

        $tabs = [];
        foreach ($locales as $locale) {
            $tabs[] = Tab::make(strtoupper($locale))
                ->schema(
                    $this->tabfields($components, $locale)
                );
        }

        $t = Tabs::make('LanguageTabs')
            ->schema(
                $tabs
            );
        $this->childComponents([
            $t,
        ]);

        return $this;
    }

    public static function make(array|Closure $schema): static
    {
        $static = app(static::class, ['schema' => $schema]);
        $static->configure();

        return $static;
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
        $tabfields[] = Hidden::make('locale')->default($locale);

        return $tabfields;
    }
}
