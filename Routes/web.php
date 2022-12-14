<?php

use Modules\Role\Http\Controllers\AssignRoleController;
use Modules\Role\Http\Controllers\RoleController;

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['auth', 'admin']], function () {
    Route::resource('roles', RoleController::class);
    Route::post('assign-role/search', [AssignRoleController::class, 'search'])->name('assign-role.search');
    Route::resource('assign-role', AssignRoleController::class)->only('index', 'store');
});
