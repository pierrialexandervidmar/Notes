<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\MainController;
use App\Http\Middleware\CheckIsLogged;
use App\Http\Middleware\CheckIsNotLogged;
use Illuminate\Support\Facades\Route;

Route::middleware([CheckIsNotLogged::class])->group(function() {
    Route::get('/login', [AuthController::class, 'login']);
    Route::post('/loginSubmit', [AuthController::class, 'loginSubmit']);
  });
  
  
  Route::middleware([CheckIsLogged::class])->group(function() {
    Route::get('/', [MainController::class, 'index'])->name('home');
    Route::get('/newNote', [MainController::class, 'newNote'])->name('new');
    Route::post('/submitNote', [MainController::class, 'submitNote'])->name('submitNote');

    Route::get('/editNode/{id}', [MainController::class, 'editNode'])->name('edit');
    Route::post('/editNodeSubmit', [MainController::class, 'editNodeSubmit'])->name('editNoteSubmit');
    Route::get('/deleteNode/{id}', [MainController::class, 'deleteNode'])->name('delete');

    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
  }); 