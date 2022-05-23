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

Route::prefix('dashboard')->middleware('auth:sanctum')->group(function () {

    /* Routes du dashboard */
    Route::get('/', [\App\Http\Controllers\CommitteeController::class, 'index'])->middleware('admin')->name('dashboard.index');
    Route::get('/{id}', [\App\Http\Controllers\CommitteeController::class, 'show'])->middleware('comite')->name('dashboard.show');
    Route::post('/{id}', [\App\Http\Controllers\CommitteeController::class, 'store'])->middleware('admin')->name('dashboard.store');
    Route::put('/{id}', [\App\Http\Controllers\CommitteeController::class, 'update'])->name('dashboard.update');
    Route::delete('/{id}', [\App\Http\Controllers\CommitteeController::class, 'destroy'])->middleware('admin')->name('dashboard.destroy');

    /* Routes des évenements */
    Route::get('/events', [\App\Http\Controllers\EventController::class, 'index'])->name('events.index');
    Route::get('/events/{id}', [\App\Http\Controllers\EventController::class, 'show'])->name('events.show');
    Route::post('/events/{id}', [\App\Http\Controllers\EventController::class, 'store'])->name('events.store');
    Route::put('/events/{id}', [\App\Http\Controllers\EventController::class, 'update'])->name('events.update');
    Route::delete('/events/{id}', [\App\Http\Controllers\EventController::class, 'destroy'])->name('events.destroy');

    /* Routes des associations */
    Route::get('/associations', [\App\Http\Controllers\EventController::class, 'index'])->name('associations.index');
    Route::get('/associations/{id}', [\App\Http\Controllers\EventController::class, 'show'])->name('associations.show');
    Route::post('/associations/{id}', [\App\Http\Controllers\EventController::class, 'store'])->name('associations.store');
    Route::put('/associations/{id}', [\App\Http\Controllers\EventController::class, 'update'])->name('associations.update');
    Route::delete('/associations/{id}', [\App\Http\Controllers\EventController::class, 'destroy'])->name('associations.destroy');
});
