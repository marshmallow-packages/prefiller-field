<?php

use Illuminate\Support\Facades\Route;

Route::post('/', '\Marshmallow\PrefillerField\Http\Controllers\PrefillController@filler');
