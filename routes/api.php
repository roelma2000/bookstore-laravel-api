<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfilesController;

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

//Book routes
Route::get('books', [BookController::class, 'getBooks']);
Route::post('books', [BookController::class, 'createBook']);
Route::patch('books', [BookController::class, 'patchBook']);
Route::get('books/{id}', [BookController::class, 'getBookById']);
Route::put('books/{id}', [BookController::class, 'updateBook']);
Route::delete('books/{id}', [BookController::class, 'deleteBook']);

//User routes
// Route::get('users', [UserController::class, 'getAllUsers']);
Route::middleware('auth:sanctum')->get('/users', [UserController::class, 'getAllUsers']);

Route::post('users', [UserController::class, 'createUser']);
Route::get('users/{id}', [UserController::class, 'getUserById']);
Route::put('users/{id}', [UserController::class, 'updateUserId']);
Route::delete('users/{id}', [UserController::class, 'deleteUserId']);


// Profiles
Route::get('profiles', [ProfilesController::class, 'getAllProfiles']);
Route::post('profiles', [ProfilesController::class, 'createProfile']);


