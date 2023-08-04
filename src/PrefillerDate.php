<?php

namespace Marshmallow\PrefillerField;

use Laravel\Nova\Fields\Date;
use Marshmallow\PrefillerField\Traits\Prefillable;

class PrefillerDate extends Date
{
    use Prefillable;

    /**
     * The field's component.
     *
     * @var string
     */
    public $component = 'prefiller-field';

    public $nova_vue_component = 'form-date-field';
}
