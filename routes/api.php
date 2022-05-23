<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AssociationController;
use App\Http\Controllers\CommitteeController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\RiverainsController;
use App\Http\Controllers\HomeController;
use Laravel\Sanctum\Sanctum;


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResources([
    '/events' => EventController::class,
    '/associations' => AssociationController::class,
    '/committees' => CommitteeController::class,
]);

Route::get('/committees/nearest', [HomeController::class, "calcultop3assocomite"]);

Route::post(
    '/mails',
    [RiverainsController::class, 'store']
);

// Route::post(
//     '/register',
//     function (Request $request) {
//         return response(205);
//     }
// );

Route::redirect('/', 'http://localhost:8080/connect')->name('login');

Route::prefix('auth')->group(function () {
    Route::post('/login', [\App\Http\Controllers\Auth\Api\LoginController::class, 'login']);
    Route::post('/logout', [\App\Http\Controllers\Auth\Api\LoginController::class, 'logout'])->middleware('auth:sanctum');
    Route::post('/register', [\App\Http\Controllers\Auth\Api\RegisterController::class, 'register']);
});

Route::prefix('dashboard')->middleware('auth:sanctum')->group(function (){
    Route::get('/', [\App\Http\Controllers\CommitteeController::class, 'index'])->middleware('admin')->name('dashboard.index');
    Route::get('/{committee_id?}', [\App\Http\Controllers\CommitteeController::class, 'show'])->middleware('comite')->name('dashboard.show');



});
