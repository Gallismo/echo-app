<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HttpController as controller;

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

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::get('/authors', [controller::class, 'authorsList']);
Route::get('/categories', [controller::class, 'categoryList']);
Route::get('/posts', [controller::class, 'postList']);
Route::get('/author/{query}', [controller::class, 'author']);
Route::get('/category/{query}', [controller::class, 'category']);
Route::get('/post/{query}', [controller::class, 'post']);
