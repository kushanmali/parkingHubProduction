<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\userController;
use App\Http\Controllers\ownerController;
use App\Http\Controllers\publicController;
use App\Http\Controllers\genaralController;
use App\Http\Controllers\parkingController;
use App\Http\Controllers\dashboardController;
use App\Http\Controllers\publicUserController;
use App\Http\Controllers\parkingSessionController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/parkings/all', [ParkingController::class, 'getAllParkings'])->name('parkings.all');
Route::get('/my-parkings/all', [ParkingController::class, 'getMyAllParkings'])->name('myparkings.all');
Route::get('/', [publicController::class, 'index'])->name('index');
Route::get('/public-user', [publicController::class, 'publicUserLogin'])->name('publicUserLogin');
Route::get('/parkings/nearby', [parkingController::class, 'findNearbyParkings'])->name('parkings.nearby');

Route::controller(publicController::class)->group(function () {
    Route::post('/request-otp', 'requestOtp')->name('requestOtp');
    Route::get('/confirm-otp', 'confirmOtp')->name('confirmOtp');
    Route::post('/verfiy-otp', 'verifyOtp')->name('verifyOtp');
    Route::post('/resend-otp', 'resendOtp')->name('resendOtp');
    Route::get('/customer-register', 'customerRegister')->name('customerRegister');
    Route::post('/storeCustomer', 'registeAuthCustomer')->name('registeAuthCustomer');
});

Route::controller(genaralController::class)->group(function () {
    // Route::get('/', 'home')->name('home');
    Route::get('/setdashboard', 'setDashboard')->name('setDashboard');
    Route::get('/dashboard', 'setDashboard')->name('dashboard');
    Route::get('/set-new-password', 'setNewPass')->name('setNewPass');
    Route::post('set-new-pass', 'setNewPassword')->name('setNewPassword');
    Route::get('/user-login', 'userLogin')->name('userLogin');
});

Route::middleware([ 'auth:sanctum', config('jetstream.auth_session'), 'verified', ])->group(function () {
    Route::get('/dashboard', function () { return view('dashboard'); })->name('dashboard');
});

Route::prefix('admin')->middleware(['auth:sanctum', 'role:Admin','checkPasswordReset', config('jetstream.auth_session'), 'verified',])->group(function () {

    Route::controller(dashboardController::class)->group(function () {
        Route::get('/dashboard', 'getAdminDashboard')->name('adminDashboard');
    });

});

Route::controller(userController::class)->group(function () {
    Route::post('/store-new-user', 'storeUser')->name('storeUser');
    Route::post('/delete-user/{id}', 'deleteUser')->name('deleteUser');
});

Route::prefix('user')->middleware(['auth:sanctum', 'role:User','checkPasswordReset', config('jetstream.auth_session'), 'verified',])->group(function () {

    Route::controller(dashboardController::class)->group(function () {
        Route::get('/dashboard', 'userDashboard')->name('userDashboard');
    });

    Route::controller(publicUserController::class)->group(function () {
        Route::get('/myMap', 'myMap')->name('myMap');
        Route::get('view-user-parking/{id}', 'viewUserParking')->name('viewUserParking');
        Route::get('parking-location/{id}', 'getParkingLocation')->name('parking.location');
        Route::get('book-now-page/{id}', 'bookNowPage')->name('bookNowPage');
        Route::get('my-bookings', 'myBookings')->name('myBookings');
    });

    Route::controller(parkingSessionController::class)->group(function () {
        Route::get('/create-parking-session/{parking}','create')->name('parking.session.create');
        Route::get('/cancel-page/{id}', 'cancelPage')->name('cancelPage');
        Route::post('cancel-parking-session/{id}', 'cancelParking')->name('cancelParking');
    });

});

Route::middleware(['auth:sanctum', 'role:Admin','checkPasswordReset', config('jetstream.auth_session'), 'verified',])->group(function () {

    Route::controller(userController::class)->group(function () {
        Route::get('/new-user', 'getNewUser')->name('newUser');
        Route::get('/system-users', 'sysUsers')->name('sysUsers');
        Route::get('/show-password/{id}/{tempPass}', 'showPass')->name('showPass');
        Route::get('/get-user-update/{id}', 'getUpdateUser')->name('getUpdateUser');
        Route::post('update-user{id}', 'updateUser')->name('updateUser');
        Route::post('updateUserPassword/{id}', 'updateUserPassword')->name('updateUserPassword');
        Route::post('/delete-user/{id}', 'deleteUser')->name('deleteUser');
        Route::get('/user/{id}', 'user')->name('user');
    });

    Route::controller(ownerController::class)->group(function () {
        Route::get('/new-owner', 'newOwner')->name('newOwner');
        Route::get('/owners', 'owners')->name('owners');
        Route::get('owner/{id}', 'owner')->name('owner');
        Route::get('update-owner/{id}', 'updateOwner')->name('updateOwner');
        Route::post('delete-owner/{id}', 'deleteOwner')->name('deleteOwner');
    });

});

Route::middleware(['auth:sanctum','role:Owner|Admin','checkPasswordReset', config('jetstream.auth_session'), 'verified',])->group(function () {

    Route::controller(dashboardController::class)->group(function () {
        Route::get('/owner-dashboard', 'ownerDashboard')->name('ownerDashboard'); 
    });

});

Route::middleware(['auth:sanctum','role:Owner','checkPasswordReset', config('jetstream.auth_session'), 'verified',])->group(function () {

    Route::controller(parkingController::class)->group(function () {
        Route::get('/new-parking', 'newParking')->name('newParking'); 
        Route::post('/store-parking{id}', 'storeParking')->name('storeParking'); 
        Route::get('/my-parkings', 'myParkings')->name('myParkings');
        Route::get('show-my-parkings', 'showMyParkings')->name('showMyParkings');
        Route::get('view-parking/{id}', 'viewParking')->name('viewParking');
        Route::post('update-parking/{id}', 'updateParking')->name('updateParking');
        Route::post('delete-parking/{id}', 'deleteParking')->name('deleteParking');
        Route::get('/start-session', 'startSession')->name('start-session');
        Route::get('/parking-settings/{id}', 'parkingSettings')->name('parkingSettings');
        Route::post('add-parking-profile/{id}', 'addParkingProfile')->name('addParkingProfile');
        Route::post('store-parking-images/{id}', 'storeParkingImages')->name('storeParkingImages');
    });

    Route::controller(parkingSessionController::class)->group(function () {
        Route::get('/parking-sessions/{id}', 'parkingSessions')->name('parkingSessions'); 
        Route::get('/active-sessions', 'activeSessions')->name('activeSessions'); 
        Route::get('parking-active-sessions/{id}', 'parkingActiveSessions')->name('parkingActiveSessions');
        Route::get('finish-session/{id}', 'finishSession')->name('finishSession');
    });

});