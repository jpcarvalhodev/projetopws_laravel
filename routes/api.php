<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BooksController;
use App\Http\Controllers\GenresController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoansController;
use App\Http\Controllers\StudentsController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('/books', [BooksController::class, 'index']);
Route::get('/books/show/{id}', [BooksController::class, 'show']);
Route::post('/books', [BooksController::class, 'store']);
Route::put('/books/update/{id}', [BooksController::class, 'update']);
Route::delete('/books/delete/{id}', [BooksController::class, 'delete']);
Route::get('/books/count', [BooksController::class, 'count']);


Route::get('/genres', [GenresController::class, 'index']);
Route::get('/genres/show/{id}', [GenresController::class, 'show']);
Route::post('/genres', [GenresController::class, 'store']);
Route::put('/genres/update/{id}', [GenresController::class, 'update']);
Route::delete('/genres/delete/{id}', [GenresController::class, 'delete']);


Route::get('/loans', [LoansController::class, 'index']);
Route::get('/loans/show/{id}', [LoansController::class, 'show']);
Route::post('/loans', [LoansController::class, 'store']);
Route::put('/loans/update/{id}', [LoansController::class, 'update']);
Route::delete('/loans/delete/{id}', [LoansController::class, 'delete']);
Route::get('/loans/count', [LoansController::class, 'count']);


Route::get('/students', [StudentsController::class, 'index']);
Route::get('/students/show/{id}', [StudentsController::class, 'show']);
Route::post('/students', [StudentsController::class, 'store']);
Route::put('/students/update/{id}', [StudentsController::class, 'update']);
Route::delete('/students/delete/{id}', [StudentsController::class, 'delete']);
Route::get('/students/count', [StudentsController::class, 'count']);
