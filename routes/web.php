<?php

use App\Http\Controllers\AudioConversionController;
use App\Http\Controllers\AudioConvertionController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/conversion', function() {
    return view('convertion');
});

Route::post('/converting', [AudioConvertionController::class, 'convertWithLame'])->name('converting');

// Route::get('/convert-audio', [AudioConversionController::class, 'showConversionForm'])->name('convert.audio.form');
Route::post('/convert-audio', [AudioConversionController::class, 'convert'])->name('convert.audio');




Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
