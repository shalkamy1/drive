<?php

use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategogryController;
use App\Http\Controllers\DriveController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth')->group(function () {
    route::prefix("category")->group(function () {

        Route::get("index", [CategogryController::class, "index"])->name("category.index");
        Route::get("create", [CategogryController::class, "create"])->name("category.create");
        Route::get("edit/{id}", [CategogryController::class, "edit"])->name("category.edit");
        Route::post("store", [CategogryController::class, "store"])->name("category.store");
        Route::get("show/{id}", [CategogryController::class, "show"])->name("category.show");
        Route::get("destroy/{id}", [CategogryController::class, "destroy"])->name("category.destroy");
        Route::post("update/{id}", [CategogryController::class, "update"])->name("category.update");

    });

    Route::prefix("drives")->group(function () {

        Route::get("index", [DriveController::class, "index"])->name("drives.index");
        Route::get("create", [DriveController::class, "create"])->name("drives.create");
        Route::get("edit/{id}", [DriveController::class, "edit"])->name("drives.edit");
        Route::post("store", [DriveController::class, "store"])->name("drives.store");
        Route::get("show/{id}", [DriveController::class, "show"])->name("drives.show");
        Route::get("download/{id}", [DriveController::class, "download"])->name("drives.download");
        Route::get('publicDrives', [DriveController::class, 'publicDrives'])->name('drive.publicDrives');
        Route::get('ChangeStatues/{id}', [DriveController::class, 'ChangeStatues'])->name('drive.ChangeStatues');
        Route::get("destroy/{id}", [DriveController::class, "destroy"])->name("drives.destroy");
        Route::post("update/{id}", [DriveController::class, "update"])->name("drives.update");

    });
Route::post('user/changeImage/{id}',[RegisteredUserController::class,'changeImage'])->name('user.changeImage');
});
require __DIR__.'/auth.php';
