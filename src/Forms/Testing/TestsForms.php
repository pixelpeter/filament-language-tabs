<?php

namespace Pixelpeter\FilamentLanguageTabs\Forms\Testing;

use Closure;
use Filament\Forms\ComponentContainer;
use Filament\Forms\Components\Field;
use Illuminate\Testing\Assert;

class TestsForms extends \Filament\Forms\Testing\TestsForms
{
    function assertFormFieldIsRequired(): Closure
    {
        return function (string $fieldName, string $formName = 'form') {
            /** @phpstan-ignore-next-line */
            $this->assertFormFieldExists($fieldName, $formName);

            $livewire = $this->instance();
            $livewireClass = $livewire::class;

            /** @var ComponentContainer $form */
            $form = $livewire->{$formName};

            /** @var Field $field */
            $field = $form->getFlatFields(withHidden: true)[$fieldName];

            Assert::assertTrue(
                $field->isRequired(),
                "Failed asserting that a field with the name [{$fieldName}] is required on the form named [{$formName}] on the [{$livewireClass}] component."
            );

            return $this;
        };
    }

    function assertFormFieldIsNotRequired(): Closure
    {
        return function (string $fieldName, string $formName = 'form') {
            /** @phpstan-ignore-next-line */
            $this->assertFormFieldExists($fieldName, $formName);

            $livewire = $this->instance();
            $livewireClass = $livewire::class;

            /** @var ComponentContainer $form */
            $form = $livewire->{$formName};

            /** @var Field $field */
            $field = $form->getFlatFields(withHidden: true)[$fieldName];

            Assert::assertFalse(
                $field->isRequired(),
                "Failed asserting that a field with the name [{$fieldName}] is not required on the form named [{$formName}] on the [{$livewireClass}] component."
            );

            return $this;
        };
    }
}
