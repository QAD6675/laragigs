<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\jobsController;
use App\Http\Controllers\usersController;

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
// main route
Route::get('/', [jobsController::class,'index']);

// auth routes
Route::get('/auth/login', [usersController::class , 'login'])->middleware('guest')->name('login');

Route::get('/auth/register', [usersController::class , 'register'])->middleware('guest');

// job routes

Route::get('/jobs/{job}/edit', [jobsController::class , 'edit'])->middleware('auth');

Route::get('/jobs/manage', [jobsController::class , 'manage'])->middleware('auth');

Route::get('/jobs/create', [jobsController::class , 'create'])->middleware('auth');

Route::get('/jobs/{job}', [jobsController::class ,'show']);

//data modifing routes GET POST PUT DELETE

Route::put('/jobs/{job}', [jobsController::class, 'update'])->middleware('auth');

Route::delete('/jobs/{job}/delete', [jobsController::class, 'destroy'])->middleware('auth');

Route::post('/leave',[usersController::class ,'logOut'])->middleware('auth');

Route::post('/auth/signin',[usersController::class ,'signIn'])->middleware('guest');

Route::post('/jobs', [jobsController::class , 'store'])->middleware('auth');

Route::post('/auth/register', [usersController::class , 'signUp'])->middleware('guest');


