<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AssociationController;
use App\Http\Controllers\CommitteeController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\DashboardController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/events/{association_id}', [EventController::class, 'showAll']);

Route::get('/associations/{committee_id}', [AssociationController::class, 'showAll']);

Route::get('/', function () {
    return view('welcome');
});

// Route::post(
//     '/associations', [AssociationController::class, 'store']
// );

Route::group(['prefix'=>'dashboard','as'=>'dashboard'], function(){

    Route::get('/', ['as' => 'index', 'uses' => 'DashboardController@index']);

    Route::group(['prefix'=>'committee','as'=>'committee'], function(){
        Route::get('/{id}', ['as' => 'show', 'uses' => 'CommitteeController@index']);
        Route::get('/edit', ['as' => 'edit', 'uses' => 'CommitteeController@edit']);
        Route::put('/edit/{id}', ['as' => 'update', 'uses' => 'CommitteeController@update']);
    });

    Route::group(['prefix'=>'associations','as'=>'associations'], function(){
        Route::get('/', ['as' => 'index', 'uses' => 'AssociationController@index']);
        Route::get('/{id}', ['as' => 'show', 'uses' => 'AssociationController@show']);
        Route::get('/edit', ['as' => 'edit', 'uses' => 'AssociationController@edit']);
        Route::put('/edit/{id}', ['as' => 'update', 'uses' => 'AssociationController@update']);
        Route::delete('/{id}', ['as' => 'destroy', 'uses' => 'CommitteeController@destroy']);
    });

    Route::group(['prefix'=>'events','as'=>'events'], function(){
        Route::get('/', ['as' => 'index', 'uses' => 'EventController@index']);
        Route::get('/{id}', ['as' => 'show', 'uses' => 'EventController@show']);
        Route::get('/edit', ['as' => 'edit', 'uses' => 'EventController@edit']);
        Route::put('/edit/{id}', ['as' => 'update', 'uses' => 'EventController@update']);
        Route::delete('/{id}', ['as' => 'destroy', 'uses' => 'EventController@destroy']);
    });

});
 