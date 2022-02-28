<?php

use App\Http\Controllers\API\APIController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('search',[APIController::class,'index'])->name("search");

Route::get("apache_service_dbs",[APIController::class,"apache_service_dbs"])
->name("apache_service_dbs");

Route::post("createAlert/{id}",[APIController::class,"createAlert"])
->name("createAlert");

Route::post("editAlert/{id}",[APIController::class,"editAlert"])
->name("createditAlerteAlert");
/**
 * ALERT FROM USER
 */
Route::get("allAlert/{id}",[APIController::class,"allAlert"])
->name("allAlert");

Route::get("delete/{id}",[APIController::class,"deleteAlert"])
->name("deleteAlert");

