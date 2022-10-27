<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Models\User;
use App\Http\Controllers\VolcanoController;

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

Route::post('/auth/register',[AuthController::class,'register']);
Route::post('/auth/login',[AuthController::class,'login']);


Route::group(['middleware' => ['auth:sanctum']], function(){
    
    Route::get('/me', function(Request $request){
        return auth()->user();
    });
    Route::post('/auth/logout',[AuthController::class,'logout']);
    Route::get('/list',[AuthController::class,'list']);

    Route::post('volcano/create',[VolcanoController::class,'store']);
    Route::get('volcano/{id}',[VolcanoController::class,'show']);
    Route::get('volcanoes',[VolcanoController::class,'index']);

    Route::post('volcano/update/{id}',[VolcanoController::class,'update']);
    Route::post('volcano/delete/{id}',[VolcanoController::class,'destroy']);
}); 