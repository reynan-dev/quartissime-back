<?php

use Illuminate\Http\Request;
use App\Http\Controllers\AssociationController;
use App\Http\Controllers\CommitteeController;
use App\Http\Controllers\EventController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::apiResources([
    '/events' => EventController::class,
    '/associations' => AssociationController::class,
    '/committees' => CommitteeController::class,
]);

Route::get([
    '/events/{association_id}' => [EventController::class, 'showAll'],
    '/associations/{committee_id}' => [AssociationController::class, 'showAll'],
]);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
