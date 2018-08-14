<?php

use \Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['web'], 'namespace' => 'IXOSoftware\PlanManagement\Controllers'], function()
{
    Route::group(['prefix' => 'dashboard'], function() {
        Route::get('/plans/anyData', 'PlanController@anyData')->name('plan.anyData');
        Route::resource('plans', 'PlanController');
    });

});
