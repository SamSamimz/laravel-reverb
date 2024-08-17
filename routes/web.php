<?php

use App\Http\Controllers\ChatController;
use App\Http\Controllers\ProfileController;
use App\Livewire\ChatComponent;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard',[ChatController::class,'index'])->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/chat/{username}',ChatComponent::class)->middleware(['auth', 'verified'])->name('chat.index');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';