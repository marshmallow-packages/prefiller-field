<?php

namespace Marshmallow\PrefillerField;

use Laravel\Nova\Fields\Select;
use Marshmallow\PrefillerField\Traits\Prefillable;

class PrefillerSelect extends Select
{
    use Prefillable;

    /**
     * The field's component.
     *
     * @var string
     */
    public $component = 'prefiller-field';

    public $nova_vue_component = 'form-select-field';
}
