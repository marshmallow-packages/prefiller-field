<?php

namespace Marshmallow\PrefillerField\Traits;

trait Prefillable
{
    public function __construct($name, $attribute = null, $resolveCallback = null)
    {
        parent::__construct($name, $attribute, $resolveCallback);
        $this->withMeta([
            'nova_vue_compontent' => $this->nova_vue_compontent,
            'update_filled_allowed' => false,
            'source_column' => 'id',
        ]);
    }

    public function allowUpdatingFilledFields()
    {
        return $this->withMeta([
            'update_filled_allowed' => true,
        ]);
        return $this;
    }

    public function fieldType($type)
    {
        return $this->withMeta([
            'field_type' => $type,
        ]);
        return $this;
    }

    public function sourceField($source_field)
    {
        return $this->withMeta([
            'source_field' => $source_field,
        ]);
        return $this;
    }

    public function sourceModel($source_model)
    {
        return $this->withMeta([
            'source_model' => $source_model,
        ]);
        return $this;
    }

    public function sourceColumn($source_column)
    {
        return $this->withMeta([
            'source_column' => $source_column,
        ]);
        return $this;
    }

    public function prefillWith($prefill_with)
    {
        return $this->withMeta([
            'prefill_with' => $prefill_with,
        ]);
        return $this;
    }

    public function build()
    {
        return $this;
    }
}
