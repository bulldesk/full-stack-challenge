<?php

Broadcast::routes();

Route::get('{any}', function () {
    return view('welcome');
})->where('any', '.*');
