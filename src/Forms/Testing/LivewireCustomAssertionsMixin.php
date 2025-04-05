<?php

namespace Pixelpeter\FilamentLanguageTabs\Forms\Testing;

use Closure;
use Filament\Forms\ComponentContainer;
use Filament\Forms\Contracts\HasForms;
use Illuminate\Testing\Assert;
use Livewire\Features\SupportTesting\Testable;

/**
 * @method HasForms instance()
 *
 * @mixin Testable
 */
class LivewireCustomAssertionsMixin
{
    public function assertFormFieldIsRequired(): Closure
    {
        return function (string $fieldName, string $formName = 'form') {
            /** @phpstan-ignore-next-line */
            $this->assertFormFieldExists($fieldName, $formName);

            $livewire = $this->instance();
            $livewireClass = $livewire::class;

            $form = $livewire->{$formName};

            $field = $form->getFlatFields(withHidden: true)[$fieldName];

            Assert::assertTrue(
                $field->isRequired(),
                "Failed asserting that a field with the name [{$fieldName}] is required on the form named [{$formName}] on the [{$livewireClass}] component."
            );

            return $this;
        };
    }

    public function assertFormFieldIsNotRequired(): Closure
    {
        return function (string $fieldName, string $formName = 'form') {
            /** @phpstan-ignore-next-line */
            $this->assertFormFieldExists($fieldName, $formName);

            $livewire = $this->instance();
            $livewireClass = $livewire::class;

            /** @var ComponentContainer $form */
            $form = $livewire->{$formName};

            $field = $form->getFlatFields(withHidden: true)[$fieldName];

            Assert::assertFalse(
                $field->isRequired(),
                "Failed asserting that a field with the name [{$fieldName}] is not required on the form named [{$formName}] on the [{$livewireClass}] component."
            );

            return $this;
        };
    }
}
