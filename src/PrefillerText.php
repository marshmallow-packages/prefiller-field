<?php

namespace Marshmallow\PrefillerField;

use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Field;
use Marshmallow\PrefillerField\Traits\Prefillable;

class PrefillerText extends Text
{
	use Prefillable;

    /**
     * The field's component.
     *
     * @var string
     */
    public $component = 'prefiller-field';

    public $nova_vue_compontent = 'form-text-field';
}
