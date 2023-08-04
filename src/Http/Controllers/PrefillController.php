<?php

namespace Marshmallow\PrefillerField\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PrefillController extends Controller
{
    public function filler(Request $request)
    {
        if (!$request->source_value) {
            return;
        }

        $model_class = '\\' . $request->source_model;
        $resource = $model_class::where($request->source_column, $request->source_value)->first();
        if (!$resource) {
            if (method_exists($model_class, 'noPrefillerResultFound')) {
                $value = $model_class::noPrefillerResultFound($request->source_value, $request->prefill_with);
                return response()->json([
                    'value' => $value,
                ]);
            } else {
                return response()->json([
                    'value' => null,
                ]);
            }
        }

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
