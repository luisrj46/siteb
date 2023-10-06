<?php

use App\Http\Controllers\Banner\BannerController;
use Illuminate\Http\Request;
use App\Http\Controllers\CountryCity\GetCountryCityController;
use App\Http\Controllers\Property\PropertyController;
use App\Http\Controllers\Property\getRelationsPropertiesController;
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

