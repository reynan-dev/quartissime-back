<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AssociationController;
use App\Http\Controllers\CommitteeController;
use App\Http\Controllers\EventController;



Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');




Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResources([
    '/events' => EventController::class,
    '/associations' => AssociationController::class,
    '/committees' => CommitteeController::class,
]);

// Route::post(
//     '/associations', [AssociationController::class, 'store']
// );

Route::post(
    '/register',
    function (Request $request) {
        return response(205);
    }
);

Route::prefix('auth')->group(function() {
    Route::post('/login/admin', [\App\Http\Controllers\Auth\Api\LoginController::class, 'loginAdmin']);
    Route::post('/login/comite', [\App\Http\Controllers\Auth\Api\LoginController::class, 'loginComite']);
    Route::post('/logout', [\App\Http\Controllers\Auth\Api\LoginController::class, 'logout'])->middleware('auth:sanctum');
  /*  Route::post('/get/token', [\App\Http\Controllers\Auth\Api\LoginController::class, 'getToken']); */
    Route::post('/register', [\App\Http\Controllers\Auth\Api\RegisterController::class, 'register']);
});
