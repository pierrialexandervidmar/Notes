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
    
    // Criar notas
    Route::get('/newNote', [MainController::class, 'newNote'])->name('new');
    Route::post('/submitNote', [MainController::class, 'submitNote'])->name('submitNote');

    // Editar notas
    Route::get('/editNote/{id}', [MainController::class, 'editNote'])->name('edit');
    Route::post('/editNoteSubmit', [MainController::class, 'editNoteSubmit'])->name('editNoteSubmit');
    
    // Deletar notas
    Route::get('/deleteNote/{id}', [MainController::class, 'deleteNote'])->name('deleteNote');
    Route::get('/deleteNoteConfirm/{id}', [MainController::class, 'deleteNoteConfirm'])->name('deleteNoteConfirm');

    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
  });
