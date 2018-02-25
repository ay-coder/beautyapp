<?php

Route::group([
    'namespace'  => 'Ingredient',
], function () {

	Route::get('ingredient/get', 'AdminIngredientController@getTableData')->name('ingredient.get-list-data');
    
    /*
     * Admin Product Controller
     */
    Route::resource('ingredient', 'AdminIngredientController');

    Route::get('/', 'AdminIngredientController@index')->name('ingredient.index');
    
});
