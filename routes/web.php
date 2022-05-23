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

    Route::get('/', ['as' => 'index', 'uses' => 'App\Http\Controllers\DashboardController@index']);

    Route::group(['prefix'=>'committee','as'=>'committee'], function(){
        Route::get('/{id}', ['as' => 'show', 'uses' => 'App\Http\Controllers\CommitteeController@index']);
        Route::get('/edit', ['as' => 'edit', 'uses' => 'App\Http\Controllers\CommitteeController@edit']);
        Route::put('/edit/{id}', ['as' => 'update', 'uses' => 'App\Http\Controllers\CommitteeController@update']);
    });

    Route::group(['prefix'=>'associations','as'=>'associations'], function(){
        Route::get('/', ['as' => 'index', 'uses' => 'App\Http\Controllers\AssociationController@index']);
        Route::get('/{id}', ['as' => 'show', 'uses' => 'App\Http\Controllers\AssociationController@show']);
        Route::get('/edit', ['as' => 'edit', 'uses' => 'App\Http\Controllers\AssociationController@edit']);
        Route::put('/edit/{id}', ['as' => 'update', 'uses' => 'App\Http\Controllers\AssociationController@update']);
        Route::delete('/{id}', ['as' => 'destroy', 'uses' => 'App\Http\Controllers\AsscoationController@destroy']);
    });

    Route::group(['prefix'=>'events','as'=>'events'], function(){
        Route::get('/', ['as' => 'index', 'uses' => 'App\Http\Controllers\EventController@index']);
        Route::get('/{id}', ['as' => 'show', 'uses' => 'App\Http\Controllers\EventController@show']);
        Route::get('/create', ['as' => 'show', 'uses' => 'App\Http\Controllers\EventController@create']);
        Route::post('/store', ['as' => 'show', 'uses' => 'App\Http\Controllers\EventController@store']);
        Route::get('/edit', ['as' => 'edit', 'uses' => 'App\Http\Controllers\EventController@edit']);
        Route::put('/edit/{id}', ['as' => 'update', 'uses' => 'App\Http\Controllers\EventController@update']);
        Route::delete('/{id}', ['as' => 'destroy', 'uses' => 'App\Http\Controllers\EventController@destroy']);
    });

});
 