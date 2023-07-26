<?php

namespace Marshmallow\PrefillerField;

use Laravel\Nova\Fields\Field;
use Laravel\Nova\Fields\Currency;
use Marshmallow\PrefillerField\Traits\Prefillable;

class PrefillerCurrency extends Currency
{
    use Prefillable;
    /**
     * The field's component.
     *
     * @var string
     */
    public $component = 'prefiller-field';

    public $nova_vue_component = 'form-currency-field';
}
