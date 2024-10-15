<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TrafficSourceController;

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



Route::post('/traffic-source', [TrafficSourceController::class, 'store']);
Route::get('/test-phone-number', [TrafficSourceController::class, 'checkPhoneNumber']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
