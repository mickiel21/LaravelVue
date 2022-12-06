<?php
Route::prefix('/user')->name('user.')->group(function () {
    // USER LIST
    Route::get('/', 'UserController@index')->name('index');
  
    // SHOW USER
    Route::get('/{id}', 'UserController@show')->name('show');

    // CREATE USER
    Route::post('/', 'UserController@store')->name('store');

    // UPDATE USER
    Route::put('/{id}', 'UserController@update')->name('update');
    
    // DELETE USER
    Route::delete('/{id}', 'UserController@delete')->name('archive');

    // RESTORE USER
    Route::get('/restore/{id}', 'UserController@restore')->name('restore');

});