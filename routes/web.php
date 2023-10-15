<?php

use App\RMVC\Route\Route;

use App\Http\Controllers\AnswerController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VoteController;
use App\Http\Controllers\API\VoteController as ApiVoteController;

//Route::get('/', function (){echo 'callable';}); // на будущее
Route::get('/', [IndexController::class])->name('main.index');

Route::get('/user/registration', [UserController::class, 'register']);
Route::post('/user/store', [UserController::class, 'store']);
Route::get('/user/login', [UserController::class, 'login']);
Route::post('/user/login', [UserController::class, 'auth']);

Route::get('/user/logout', [UserController::class, 'logout'])->middleware('auth');
Route::get('/user/personal', [UserController::class, 'personal'])->middleware('auth');

Route::get('/votes', [VoteController::class, 'index'])->middleware('auth');
Route::post('/votes/create', [VoteController::class, 'create'])->middleware('auth');
Route::post('/votes/store', [VoteController::class, 'store'])->middleware('auth');
Route::post('/votes/{vote}/edit', [VoteController::class, 'edit'])->middleware('auth');
Route::patch('/votes/{vote}/edit', [VoteController::class, 'update'])->middleware('auth');
Route::delete('/votes/{vote}/delete', [VoteController::class, 'delete'])->middleware('auth');

Route::get('/votes/{vote}', [AnswerController::class, 'index'])->middleware('auth');
Route::post('/votes/{vote}/answer/create', [AnswerController::class, 'create'])->middleware('auth');
Route::post('/votes/{vote}/answer/store', [AnswerController::class, 'store'])->middleware('auth');
Route::post('/votes/{vote}/answer/{answer}/edit', [AnswerController::class, 'edit'])->middleware('auth');
Route::patch('/votes/{vote}/answer/{answer}/edit', [AnswerController::class, 'update'])->middleware('auth');
Route::delete('/votes/{vote}/answer/{answer}/delete', [AnswerController::class, 'delete'])->middleware('auth');

Route::get('/api/votes', [ApiVoteController::class, 'index']);
Route::post('/api/votes', [ApiVoteController::class, 'index_auth']);
