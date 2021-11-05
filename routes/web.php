<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\gebruikerController;
use App\Http\Controllers\profielController;
use App\Http\Controllers\gezFormController;
use App\Http\Controllers\gezFormNewController;
use App\Http\Controllers\gezFormEditController;
use App\Http\Controllers\pdfController;
use App\Http\Controllers\fileController;

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

// "/" //
Route::get('/', [AuthenticatedSessionController::class, 'create'])
    ->middleware('guest');

// "/dashboard" //
Route::get('/dashboard', function () {
    return view('dashboard');
    })->middleware(['auth'])
    ->name('dashboard');

// "/gebruikers" //
Route::get('/gebruikers', [gebruikerController::class, 'view'])
    ->middleware('auth')
    ->name('gebruikers');

    Route::get('/gebruikers/edit/{id}', [gebruikerController::class, 'viewEdit'])
        ->middleware('auth')
        ->name('gebruikers.edit');

    Route::post('/gebruikers/edit/saved', [gebruikerController::class, 'edit'])
        ->middleware('auth');

    Route::get('/gebruikers/edit/deleted/{id}', [gebruikerController::class, 'delete'])
        ->middleware('auth')
        ->name('gebruikers.delete');

    Route::post('/gebruikers/edit/rol/{id}', [gebruikerController::class, 'editRole'])
        ->middleware('auth')
        ->name('gebruikers.edit.role');

// "/profiel" //
Route::get('/profiel', [profielController::class, 'show'])
    ->middleware(['auth'])
    ->name('profiel');

    Route::post('/profiel/savedData', [profielController::class, 'store'])
        ->middleware(['auth']);

    Route::post('/profiel/savedPassword', [profielController::class, 'newPassword'])
        ->middleware(['auth']);

    Route::get('/profiel/delete', [profielController::class, 'delete'])
        ->middleware(['auth'])
        ->name('profiel.delete');

// "/gezforms" //
Route::get('/gezforms', [gezFormController::class, 'view'])
    ->middleware('auth')
    ->name('gezforms');

Route::get('/gezforms/{id}', [gezFormController::class, 'updateSame'])
    ->middleware('auth')
    ->name('gezforms.updateSame');

Route::post('/gezforms', [gezFormController::class, 'view'])
    ->middleware('auth')
    ->name('gezforms.filter');

    // New //
    Route::get('/gezforms/afbreken', [GezFormNewController::class, 'cancel'])
        ->middleware('auth')
        ->name('gezforms.afbreken');

    Route::get('/gezforms/nieuw/{category}', [GezFormNewController::class, 'view'])
        ->middleware('auth')
        ->name('gezforms.new');

    Route::post('/gezforms/nieuw/algemeen', [GezFormNewController::class, 'createAlgemeen'])
        ->middleware(['auth']);

    Route::post('/gezforms/nieuw/adressen', [GezFormNewController::class, 'createAdressen'])
        ->middleware(['auth']);

    Route::post('/gezforms/nieuw/medische-gegevens', [GezFormNewController::class, 'createMedischegegevens'])
        ->middleware(['auth']);

    Route::post('/gezforms/nieuw/opslaan', [GezFormNewController::class, 'store'])
        ->middleware(['auth']);

    // Edit //
    Route::get('/gezforms/edit/{id}/{category}', [GezFormEditController::class, 'view'])
        ->middleware('auth')
        ->name('gezforms.edit');

    Route::post('/gezforms/edit/{id}/algemeen', [GezFormEditController::class, 'editAlgemeen'])
        ->middleware(['auth']);

    Route::post('/gezforms/edit/{id}/adressen', [GezFormEditController::class, 'editAdressen'])
        ->middleware(['auth']);

    Route::post('/gezforms/edit/{id}/medische-gegevens', [GezFormEditController::class, 'editMedischegegevens'])
        ->middleware(['auth']);

    Route::get('/gezforms/deleted/{id}', [gezFormEditController::class, 'delete'])
        ->middleware('auth')
        ->name('gezforms.delete');

// "/pdf" //
Route::get('/pdf/{id}', [pdfController::class, 'gezformPdf'])
    ->middleware('auth')
    ->name('pdf');

// "/storage" //
Route::get('/storage/{file_name}', [fileController::class, 'index'])->where(['file_name' => '.*'])
    ->middleware('auth')
    ->name('file');

require __DIR__.'/auth.php';
