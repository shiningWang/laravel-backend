<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\BookController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::middleware('auth:sanctum')->post('/profile', [AuthController::class, 'profile']);

Route::post('/login', [AuthController::class, 'login']);

// GetAll
Route::middleware('auth:sanctum')->get('/book/read', [BookController::class, 'read']);

// Create
Route::middleware('auth:sanctum')->post('/book/create', [BookController::class, 'create']);

// Update
Route::middleware('auth:sanctum')->put('/book/update', [BookController::class, 'update']);

// Delete
Route::middleware('auth:sanctum')->delete('/book/delete', [BookController::class, 'delete']);

// Request Header Must Provide Accept application/json To Avoid Route[Home]
Route::middleware('auth:sanctum')->post('/logout', [AuthController::class, 'logout']);

Route::post('/insertDataWsRelationship', [BookController::class, 'insertDataWsRelationship']);

Route::post('/findUserByTrain', [BookController::class, 'findUserByTrain']);