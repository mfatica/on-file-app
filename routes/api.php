<?php

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

Route::middleware(['auth:api'])->group(function() {
    Route::get('/uploads', 'UploadController@getUploads');
    Route::post('/uploads', 'UploadController@uploadFile');
    Route::post('/uploads/{upload}/tags/{text}', 'UploadController@addTag');
    Route::delete('/uploads/{upload}/tags/{text}', 'UploadController@deleteTag');
});

