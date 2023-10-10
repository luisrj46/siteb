<?php

use App\Http\Controllers\BiomedicalEquipment\BiomedicalEquipmentController;
use App\Http\Controllers\BiomedicalEquipment\GetBiomedicalEquipmentController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GracePeriod\GracePeriodController;
use App\Http\Controllers\User\GetUserController;
use App\Http\Controllers\User\ProfileController;
use App\Http\Controllers\User\UserController;
use Illuminate\Support\Facades\Route;

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

Route::middleware(['auth', 'verified'])->group(function () {

    Route::get('/', [DashboardController::class, 'index']);

    Route::get('/home', [DashboardController::class, 'index'])->name('dashboard');


    Route::prefix('admin')->group(function () {

        Route::controller(UserController::class)->group(function(){
            Route::resource('users', UserController::class)->except('update');
            Route::post('users/{user}', [UserController::class, 'update'])->name('users.update');
        });

        Route::controller(BiomedicalEquipmentController::class)->group(function(){
            Route::resource('biomedicalEquipments', BiomedicalEquipmentController::class)->except('update');
            Route::post('biomedicalEquipments/{biomedicalEquipment}/update', [BiomedicalEquipmentController::class, 'update'])->name('biomedicalEquipments.update');
        });
        
        Route::get('profile', [ProfileController::class, 'editProfile'])->name('profile.edit');
        Route::post('profile', [ProfileController::class, 'update'])->name('profile.update');

    });

    Route::prefix('get')->name('get.')->group(function () {

        Route::get('type/user', [GetUserController::class, 'typeUser'])->name('typeUser');
        Route::get('type/document', [GetUserController::class, 'typeDocument'])->name('typeDocument');
        Route::get('type/phone', [GetUserController::class, 'typePhone'])->name('typePhone');

        Route::get('form/acquisition', [GetBiomedicalEquipmentController::class, 'formAcquisition'])->name('form.acquisition');
        Route::get('property', [GetBiomedicalEquipmentController::class, 'property'])->name('property');
        Route::get('period', [GetBiomedicalEquipmentController::class, 'period'])->name('period');
        Route::get('yes/not', [GetBiomedicalEquipmentController::class, 'yesNot'])->name('yes.not');
        Route::get('plan', [GetBiomedicalEquipmentController::class, 'plan'])->name('plan');
        Route::get('use/biomedical', [GetBiomedicalEquipmentController::class, 'useBiomedical'])->name('use.biomedical');
        Route::get('biomedical/classification', [GetBiomedicalEquipmentController::class, 'biomedicalClassification'])->name('biomedical.classification');
        Route::get('risk/class', [GetBiomedicalEquipmentController::class, 'riskClass'])->name('risk.class');


    });
});

Route::get('/error', function () {
    abort(500);
});


require __DIR__ . '/auth.php';
