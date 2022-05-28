<?php

namespace Marshmallow\PrefillerField\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PrefillController extends Controller
{
    public function filler(Request $request)
    {
        $model_class = '\\' . $request->source_model;
        $resource = $model_class::find($request->source_value);
        $prefill_with = $request->prefill_with;

        $value = null;
        if ($resource) {
            if (isset($resource->getAttributes()[$prefill_with])) {
                $value = $resource->{$prefill_with};
            } elseif (method_exists($resource, $prefill_with)) {
                $value = $resource->{$prefill_with}();
            }
        }

        return response()->json([
            'value' => $value,
        ]);
    }
}
