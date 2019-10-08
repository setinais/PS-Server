<?php

Route::post('/oauth/token','\Laravel\Passport\Http\Controllers\AccessTokenController@issueToken')->middleware(['throttle', 'verified_email']);