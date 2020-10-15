<?php

use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'auth'], function () {

    Route::get('/', 'DashboardController@index');
    Route::resource('branches', 'Admin\BranchController');
    Route::resource('devices', 'Admin\DeviceController');

    Route::prefix('device-templates')->group(function () {
        Route::get('/', 'Admin\DeviceTemplateController@index');
        Route::get('create', 'Admin\DeviceTemplateController@create');
        Route::get('show','Admin\DeviceTemplateController@show');
        Route::post('store', 'Admin\DeviceTemplateController@store_template');
        Route::delete('delete/{id}', 'Admin\DeviceTemplateController@delete_template');
        Route::put('update/{id}', 'Admin\DeviceTemplateController@update');
        Route::get('edit/{id}', 'Admin\DeviceTemplateController@edit_template');
        Route::delete('delete/{id}', 'Admin\DeviceTemplateController@delete_template');
    });

    Route::get('schedule', 'Admin\ScheduleController@index')->name('schedule');
    Route::post('ajax-data', 'Admin\ScheduleController@schedule_post')->name('ajax-data');
    Route::post('ajax-data-update', 'Admin\ScheduleController@schedule_post_update')->name('ajax-data-update');
    Route::post('ajax-data-delete', 'Admin\ScheduleController@schedule_post_delete')->name('ajax-data-delete');

    Route::resource('organization', 'Admin\OrganizationController');
    Route::resource('zones', 'Admin\ZoneController');
    Route::resource('cities', 'Admin\CityController');
    Route::resource('device-group', 'Admin\DeviceGroupController');

    Route::post('assign-organization', 'Admin\OrganizationController@assign_org');
    Route::post('assign-branches', 'Admin\BranchController@assign_branch');
    Route::post('assign-zones', 'Admin\BranchController@assign_branch');
    Route::post('assign-device-groups','Admin\DeviceGroupController@assign');
    Route::post('import-cities', 'Admin\CityController@import');

    Route::post('logout', 'LoginController@logout')->name('logout');
    Route::delete('ajax-delete-zones','Admin\ZoneController@ajax_delete_zones')->name('ajax-delete-zones');
    Route::delete('ajax-delete-branches','Admin\BranchController@ajax_delete_branches')->name('ajax-delete-branches');
    Route::post('ajax-next-device-template-setting','Admin\DeviceTemplateController@next_step')->name('next_step');
   
});

Route::get('login', 'LoginController@login_view')->name('login');
Route::post('login', 'LoginController@login');


