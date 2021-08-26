<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Seedcontroller;
use App\Http\Controllers\Datacontroller;
use App\Http\Controllers\usercontroller;
use App\Http\Controllers\Filecontroller;


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
Route::post("register",[usercontroller::class,'RegisterUser']);
Route::post("login",[usercontroller::class,'login']);
Route::post("deleteuser",[usercontroller::class,'Delete']);
Route::post("updateuser",[usercontroller::class,'UpdateUser']);
Route::post("getuser",[seedcontroller::class,'Get']);
Route::post("deleteseed",[seedcontroller::class,'DeleteSeed']);
Route::post("addSeedaddress",[Seedcontroller::class,'addSeedadress']);
Route::post("addSeed",[Seedcontroller::class,'addSeed']);
Route::get("open",[Datacontroller::class,'open']);
Route::post("upload",[Filecontroller::class,'Upload']);
Route::post("addData",[usercontroller::class,'addData']);
Route::post('PlaceBid', [Seedcontroller::class, 'AddBid']);
Route::post('GetBid', [Seedcontroller::class, 'GetBid']);
Route::post('AcceptBid', [Seedcontroller::class, 'AcceptBid']);
Route::post('UpdateBid', [Seedcontroller::class, 'UpdateBid']);
Route::post("UpdateSeed",[Seedcontroller::class,'UpdateSeed']);
Route::post("GetSeed",[Seedcontroller::class,' GetSeed']);
Route::group(['middleware' => ['jwt.verify']], function() {
Route::get('loadseeds', [Seedcontroller::class, 'LoadSeeds']);
//Route::get('closed', [Datacontroller::class, 'closed']);
});

