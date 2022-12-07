<?php
Route::prefix('/interest')->name('interest.')->group(function () {
    // INTEREST
    Route::get('/', 'InterestController@index')->name('index');
  
});