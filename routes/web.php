<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AssociationController;
use App\Http\Controllers\CommitteeController;
use App\Http\Controllers\EventController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::apiResources([
    '/events' => EventController::class,
    '/associations' => AssociationController::class,
    '/committees' => CommitteeController::class,
]);


Route::get('/events/{association_id}', [EventController::class, 'showAll']);
Route::get('/associations/{committee_id}', [AssociationController::class, 'showAll']);
