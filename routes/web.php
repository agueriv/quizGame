<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\AnswerController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;

// Home routes
Route::get('/',[HomeController::class, 'front'])-> name('home.front');
Route::post('frontlogin',[HomeController::class, 'frontlogin'])-> name('home.frontlogin');
Route::post('forgetalias',[HomeController::class, 'forgetAlias'])-> name('home.forgetalias');
Route::get('back',[HomeController::class, 'back'])-> name('home.back');
Route::post('back/login',[HomeController::class, 'login'])-> name('home.login');
Route::post('back/logout', [HomeController::class, 'logout'])->name('home.logout');

// Ruta de recursos para adminstrar las preguntas
Route::resource('back/question', QuestionController::class);
// Ruta recursos adminstrar respuestas
Route::resource('back/answer', AnswerController::class);
// Ruta recursos adminstrar historial
Route::resource('back/history', HistoryController::class);
// Ruta recursos adminstrar administradores
Route::resource('back/admin', AdminController::class);

// Ruta para ver el historial de cada alias en el front
Route::get('alias/history/{alias}',[HomeController::class, 'aliashistory'])-> name('alias.history');
// Ruta para lo que sería el display de las preguntas, el juego
Route::get('game',[HomeController::class, 'game'])-> name('front.game');
// Ruta para checkear la respuesta del user
Route::post('game',[HomeController::class, 'checktry'])-> name('front.checktry');