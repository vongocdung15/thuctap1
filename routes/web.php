<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ImageController;

Route::get('/upload_test', [ImageController::class, 'create']);
Route::get('/upload', [ImageController::class, 'store']);


Route::get('/', function () {
    return view('image-upload');
});
