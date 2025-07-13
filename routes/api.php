<?php

use App\Http\Controllers\authcontroller;
use App\Http\Controllers\FamilyMemberController;
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

Route::post("user/register", [authcontroller::class, "register"]);
Route::post("user/login", [authcontroller::class, "login"]);

Route::group(["middleware" => ['auth:sanctum']], function () {
    Route::get("user/logout", [authcontroller::class, "logout"]);
    Route::post("user/addmember", [FamilyMemberController::class, "addMember"]);
    Route::get("user/getMembers", [FamilyMemberController::class, "getallmember"]);
});
