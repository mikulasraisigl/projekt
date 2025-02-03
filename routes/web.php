<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;
use App\Http\Controllers\ActionController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\StatistikaController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::get('/plantreninku', [EventController::class, 'index'])->name('events.index');
    Route::post('/plantreninku', [EventController::class, 'store'])->name('events.store');
    Route::put('/plantreninku/{event}', [EventController::class, 'update'])->name('events.update');
    Route::delete('/plantreninku/{event}', [EventController::class, 'destroy'])->name('events.destroy');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/statistika', [StatistikaController::class, 'index'])->name('statistika.index');
    Route::post('/statistika', [StatistikaController::class, 'store'])->name('statistika.store');
});


Route::middleware(['auth'])->group(function () {
    Route::get('/poznamky', function () {

        return view('blog');
    })->name('poznamky');
    Route::get('/actions/{action}/edit', [ActionController::class, 'edit'])->name('actions.edit');
    Route::put('/actions/{action}', [ActionController::class, 'update'])->name('actions.update');
    Route::delete('/actions/{action}', [ActionController::class, 'destroy'])->name('actions.destroy');

});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');



});
Auth::routes(['verify' => true]);
require __DIR__.'/auth.php';
Route::get('/auth/{provider}', function ($provider) {
    return Socialite::driver($provider)->redirect();
});



Route::get('/blog', [ActionController::class, 'index'])->name('actions.index');

// Routa pro uložení nového záznamu
Route::post('/blog', [ActionController::class, 'store'])->name('actions.store');

