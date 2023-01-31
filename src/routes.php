<?php

use Illuminate\Support\Facades\Route;

Route::group([
    'namespace' => 'Oguz\ResponsePackage',
], function () {
    Route::get('hello-world', 'TestController@helloWorld');
});
