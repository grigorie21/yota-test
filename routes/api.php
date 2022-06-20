<?php

use App\Http\Controllers\API\CommentController;
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

Route::group(['prefix' => 'comment', 'as' => 'comment.'], function () {
    Route::get('/', [CommentController::class, 'getTopLevel'])->name('index');
    Route::get('{id}', [CommentController::class, 'getWithNested'])->name('get');
    Route::put('{id}', [CommentController::class, 'put'])->name('put');
    Route::post('/', [CommentController::class, 'post'])->name('post');
    Route::delete('{id}', [CommentController::class, 'del'])->name('delete');
});

