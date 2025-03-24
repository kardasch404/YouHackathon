<?php

use App\Http\Controllers\EditionController;
use App\Http\Controllers\HackathonController;
use App\Http\Controllers\JWTAuthController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\TeamController;
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
Route::delete('delete/{id}', [RoleController::class, 'delete']);
Route::put('update/{id}', [RoleController::class, 'update']);
Route::get('getAllRole', [RoleController::class, 'getAllRole']);



// =========================-> User <-===================================== //
// ======================================================================= //

Route::post('addUserRole', [UserController::class, 'addUserRole']);
Route::post('participierAuxEdition/{userId}/{editionId}', [UserController::class, 'participierAuxEdition']);
Route::post('joinAuxTeam/{userId}/{teamId}', [UserController::class, 'joinAuxTeam']);


// =========================-> Hackthon <-===================================== //
// ======================================================================= //

Route::post('createHackathon', [HackathonController::class, 'createHackathon']);
Route::delete('deleteHackathon/{id}', [HackathonController::class, 'deleteHackathon']);
Route::put('updatehackathon/{id}', [HackathonController::class, 'updatehackathon']);
Route::get('getHackathons', [HackathonController::class, 'getHackathons']);




// =========================-> Edition <-===================================== //
// ======================================================================= //

Route::post('createEdition/{id}', [EditionController::class, 'createEdition']);
Route::delete('deleteEdition/{userId}/{editionId}', [EditionController::class, 'deleteEdition']);
Route::put('updateEdition/{userId}/{editionId}', [EditionController::class, 'updateEdition']);


// =========================-> Team <-===================================== //
// ======================================================================= //
Route::post('createTeam/{userId}/{editionId}', [TeamController::class, 'createTeam']);
Route::delete('deleteTeam/{userId}/{teamId}', [TeamController::class, 'deleteTeam']);
Route::get('getAllTeam', [TeamController::class, 'getAllTeam']);












