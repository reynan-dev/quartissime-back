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

    Route::get('/{committeee_id}', ['as' => 'index', 'uses' => 'App\Http\Controllers\DashboardController@index'])
        ->name('dashboard.index');

    Route::group(['prefix'=>'committee','as'=>'committee'], function(){
        Route::get('/{committeee_id}', ['as' => 'show', 'uses' => 'App\Http\Controllers\CommitteeController@show'])
            ->name('committee.show');
        Route::get('/edit', ['as' => 'edit', 'uses' => 'App\Http\Controllers\CommitteeController@edit'])
            ->name('committee.edit');
        Route::put('/edit/{id}', ['as' => 'update', 'uses' => 'App\Http\Controllers\CommitteeController@update'])
            ->name('committee.update');
    });

    Route::group(['prefix'=>'associations','as'=>'associations'], function(){
        Route::get('/', ['as' => 'index', 'uses' => 'App\Http\Controllers\AssociationController@index'])
            ->name('associations.index');
        Route::get('/{id}', ['as' => 'show', 'uses' => 'App\Http\Controllers\AssociationController@show'])
            ->name('associations.show');
        Route::get('/edit', ['as' => 'edit', 'uses' => 'App\Http\Controllers\AssociationController@edit'])
            ->name('associations.edit');
        Route::put('/edit/{id}', ['as' => 'update', 'uses' => 'App\Http\Controllers\AssociationController@update'])
            ->name('associations.update');
        Route::delete('/{id}', ['as' => 'destroy', 'uses' => 'App\Http\Controllers\AsscoationController@destroy'])
            ->name('associations.destroy');
    });

    Route::resource('events', EventController::class);

   /* Route::group(['prefix'=>'events','as'=>'events'], function(){
        Route::get('/', ['as' => 'index', 'uses' => 'App\Http\Controllers\EventController@index'])
            ->name('events.index');
        Route::get('/{id}', ['as' => 'show', 'uses' => 'App\Http\Controllers\EventController@show'])
            ->name('events.show');
        Route::get('/create/{committeee_id}', ['as' => 'create', 'uses' => 'App\Http\Controllers\EventController@create'])
            ->name('events.create');
        Route::post('/store', ['as' => 'store', 'uses' => 'App\Http\Controllers\EventController@store'])
            ->name('events.store');
        Route::get('/edit', ['as' => 'edit', 'uses' => 'App\Http\Controllers\EventController@edit'])
            ->name('events.edit');
        Route::put('/edit/{id}', ['as' => 'update', 'uses' => 'App\Http\Controllers\EventController@update'])
            ->name('events.update');
        Route::delete('/{id}', ['as' => 'destroy', 'uses' => 'App\Http\Controllers\EventController@destroy'])
            ->name('events.destroy');
    }); */

});
 