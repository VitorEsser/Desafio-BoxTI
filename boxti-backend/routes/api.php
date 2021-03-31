<?php

Route::post('candidates/search', 'App\Http\Controllers\api\CandidateController@search');

Route::apiResource('candidates', 'App\Http\Controllers\api\CandidateController');

Route::apiResource('stacks', 'App\Http\Controllers\api\StackController');