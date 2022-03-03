<?php

use App\Http\Controllers\APIRoutes;
use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::prefix('admin')->middleware('auth')->group(function(){
    Route::get('/', function () {
        return view('admin.index');
    })->name("admin.index");

    Route::get('/alert', function () {
        return view('admin.alert.index');
    });
    Route::get('/alert/edit/{id}',[APIRoutes::class,'edit'])->name("alert.edit");
});
