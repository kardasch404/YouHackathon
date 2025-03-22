<?php

use App\Http\Controllers\HackathonController;
use App\Http\Controllers\JWTAuthController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Models\Hackathon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// =========================-> Auth <-===================================== //
// ======================================================================= //

Route::post('register', [JWTAuthController::class, 'register']);
Route::post('login', [JWTAuthController::class, 'login']);
Route::post('logout', [JWTAuthController::class, 'logout']);


// =========================-> Role <-===================================== //
// ======================================================================= //

Route::post('create', [RoleController::class, 'create']);
Route::delete('delete\{id}', [RoleController::class, 'delete']);
Route::put('update/{id}', [RoleController::class, 'update']);
Route::get('getAllRole', [RoleController::class, 'getAllRole']);



// =========================-> User <-===================================== //
// ======================================================================= //

Route::post('addUserRole', [UserController::class, 'addUserRole']);


// =========================-> Hackthon <-===================================== //
// ======================================================================= //

Route::post('createHackathon', [HackathonController::class, 'createHackathon']);













