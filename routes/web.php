<?php

use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\MCategoriesController;
use App\Http\Controllers\MStatusController;
use App\Http\Controllers\MCatalogueController;
use App\Http\Controllers\MSosmedController;
use App\Http\Controllers\MVissionMissionController;
use App\Http\Controllers\AboutUsController;
use App\Http\Controllers\EventsController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', [LandingPageController::class, 'index'])->name('home');
Route::get('/about', [LandingPageController::class, 'about'])->name('about');
Route::get('/gallery', [LandingPageController::class, 'gallery'])->name('gallery');
Route::get('/event', [LandingPageController::class, 'event'])->name('event');
Route::get('/event/{id}', [LandingPageController::class, 'eventDetail'])->name('event.detail');
Route::get('/gallery/{id}', [LandingPageController::class, 'catalogueDetail'])->name('catalogue.detail');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('mcategories', MCategoriesController::class);
    Route::resource('mstatus', MStatusController::class);
    Route::resource('mcatalogue', MCatalogueController::class);
    Route::resource('msosmed', MSosmedController::class);
    Route::resource('mvissionmission', MVissionMissionController::class);
    Route::resource('aboutus', AboutUsController::class);
    Route::resource('events', EventsController::class);
});

require __DIR__.'/auth.php';
