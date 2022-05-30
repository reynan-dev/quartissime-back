<?php

use Illuminate\Http\Request;
use Laravel\Sanctum\Sanctum;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\CommitteeController;
use App\Http\Controllers\RiverainsController;
use App\Http\Controllers\AssociationController;
use App\Http\Controllers\ImageUploadController;


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/committees/nearest', [HomeController::class, "calcultop3assocomite"]);

Route::get('/associations/findByComittee', [AssociationController::class, "findByComittee"]);


Route::apiResources([
    '/associations' => AssociationController::class,
    '/committees' => CommitteeController::class,
]);

Route::get('/committees/nearest', [HomeController::class, "calcultop3assocomite"]);

Route::post(
    '/mails',
    [RiverainsController::class, 'store']
);

Route::redirect('/', 'http://localhost:8080/connect')->name('login');

Route::prefix('auth')
    ->group(function () {
        Route::post('/login', [\App\Http\Controllers\Auth\Api\LoginController::class, 'login']);
        Route::post('/logout', [\App\Http\Controllers\Auth\Api\LoginController::class, 'logout'])
            ->middleware('auth:sanctum');
        Route::post('/register', [\App\Http\Controllers\Auth\Api\RegisterController::class, 'register']);
    });

Route::prefix('dashboard')
    ->middleware('auth:sanctum')
    ->group(function () {
        /* Routes du dashboard */
        Route::get('/', [\App\Http\Controllers\CommitteeController::class, 'index'])
            ->middleware('admin')
            ->name('dashboard.index');
        Route::get('/{id}', [\App\Http\Controllers\CommitteeController::class, 'show'])
            ->middleware('comite')
            ->name('dashboard.show');
        Route::get('/files/submit', [\App\Http\Controllers\FileController::class, 'test'])
            ->name('upload.submit');
    });

Route::prefix('assoc')
    ->middleware('auth:sanctum')
    ->group(function () {
        /* Routes des associations */
        Route::get('/', [\App\Http\Controllers\AssociationController::class, 'index'])
            ->name('associations.index');
        Route::get('/{id}', [\App\Http\Controllers\AssociationController::class, 'show'])
            ->name('associations.show');
        Route::post('/create', [\App\Http\Controllers\AssociationController::class, 'store'])
            ->name('associations.store');
        Route::put('/edit/{id}', [\App\Http\Controllers\AssociationController::class, 'update'])
            ->name('associations.update');
        Route::delete('/delete/{id}', [\App\Http\Controllers\AssociationController::class, 'destroy'])
            ->name('associations.destroy');

        Route::post('/accept', [\App\Http\Controllers\AssociationController::class, 'accept'])
            ->name('associations.accept');

        Route::post('/accept/all', [\App\Http\Controllers\AssociationController::class, 'acceptAll'])
            ->name('associations.acceptAll');
    });

Route::prefix('comite')
    ->middleware('auth:sanctum')
    ->group(function () {
        /* Routes des committees */
        Route::get('/', [\App\Http\Controllers\CommitteeController::class, 'index'])
            ->name('comite.index');
        Route::get('/{id}', [\App\Http\Controllers\CommitteeController::class, 'show'])
            ->name('comite.show');
        Route::post('/create', [\App\Http\Controllers\CommitteeController::class, 'store'])
            ->name('comite.store');
        Route::put('/edit/{id}', [\App\Http\Controllers\CommitteeController::class, 'update'])
            ->name('comite.update');
        Route::delete('/delete/{id}', [\App\Http\Controllers\CommitteeController::class, 'destroy'])
            ->name('comite.destroy');
    });

Route::prefix('events')
    ->middleware('auth:sanctum')
    ->group(function () {

        /* Routes des événements */
        Route::get('/', [\App\Http\Controllers\EventController::class, 'index'])
            ->name('events.index');
        Route::get('/{id}', [\App\Http\Controllers\EventController::class, 'show'])
            ->name('events.show');
        Route::post('/create', [\App\Http\Controllers\EventController::class, 'store'])
            ->name('events.store');
        Route::put('/edit/{id}', [\App\Http\Controllers\EventController::class, 'update'])
            ->name('events.update');
        Route::delete('/delete/{id}', [\App\Http\Controllers\EventController::class, 'destroy'])
            ->name('events.destroy');
    });
