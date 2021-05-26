<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\APIController;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group([ 'prefix' => 'messages'], function () {
    Route::get('public', [APIController::class, 'getPublicMessage']);
    Route::get('protected', [APIController::class, 'getProtectedMessage'])->middleware('jwt');
    Route::get('admin', [APIController::class, 'getAdminMessage']);
});


Route::fallback(function(){
    return response()->json([
        "message" => "Not Found"], 404);
});

