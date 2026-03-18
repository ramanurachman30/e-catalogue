<?php

use App\Http\Controllers\MCategoriesController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('mcategories', MCategoriesController::class)->name('mcategories', 'mcategories');
    Route::resource('mstatus', MCategoriesController::class)->name('mstatus', 'mstatus');
    Route::resource('mcatalogue', MCategoriesController::class)->name('mcatalogue', 'mcatalogue');
    Route::resource('msosmed', MCategoriesController::class)->name('msosmed', 'msosmed');
    Route::resource('mvission_mission', MCategoriesController::class)->name('mvission_mission', 'mvission_mission');
    Route::resource('mabout_us', MCategoriesController::class)->name('mabout_us', 'mabout_us');
});

require __DIR__.'/auth.php';
