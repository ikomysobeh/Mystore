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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('/add',[\App\Http\Controllers\UserController::class,'Add']);
Route::post('/login',[\App\Http\Controllers\UserController::class,'Login']);

Route::middleware('auth:sanctum')->group(function (){
    Route::prefix('/user')->group(function (){
        Route::post('/logout',[\App\Http\Controllers\UserController::class,'Logout'])->middleware('role:visitor');
        Route::post('/changPassword',[\App\Http\Controllers\UserController::class,'ChangPassword'])->middleware('role:visitor');
        Route::get('/profile',[\App\Http\Controllers\UserController::class,'Profile'])->middleware('role:visitor');
        Route::get('/view/{uniqueId?}',[\App\Http\Controllers\UserController::class,'View'])->middleware('role:admin');
        Route::get('/add-permission', [\App\Http\Controllers\UserController::class, 'addPermission'])->middleware('role:admin');
        Route::get('/delete-permission', [\App\Http\Controllers\UserController::class, 'deletePermission'])->middleware('role:admin');
        Route::get('/edit-role', [\App\Http\Controllers\UserController::class, 'editRole'])->middleware('role:admin');
        Route::get('/view-permission', [\App\Http\Controllers\UserController::class, 'viewPermission'])->middleware('role:admin');
    });
    Route::prefix('/category')->group(function () {
        Route::post('/add', [\App\Http\Controllers\CategoryController::class, 'Add'])->middleware( ['role:visitor']);
        Route::put('/edit', [\App\Http\Controllers\CategoryController::class, 'edit'])->middleware('role:visitor');
        Route::get('/view', [\App\Http\Controllers\CategoryController::class, 'view'])->middleware('role:visitor');
        Route::delete('/delete', [\App\Http\Controllers\CategoryController::class, 'delete'])->middleware('role:visitor');
    });
    Route::prefix('/file')->group(function () {
        Route::post('/add', [\App\Http\Controllers\FileController::class, 'Add'])->middleware('role:visitor');
        Route::put('/edit', [\App\Http\Controllers\FileController::class, 'edit'])->middleware('role:visitor');
        Route::get('/view', [\App\Http\Controllers\FileController::class, 'view'])->middleware('role:visitor');
        Route::delete('/delete', [\App\Http\Controllers\FileController::class, 'delete'])->middleware('role:visitor');
    });
    Route::prefix('/post')->group(function () {
        Route::post('/add', [\App\Http\Controllers\PostController::class, 'Add'])->middleware('role:visitor');
        Route::put('/edit', [\App\Http\Controllers\PostController::class, 'edit'])->middleware('role:visitor');
        Route::get('/view', [\App\Http\Controllers\PostController::class, 'view'])->middleware('role:visitor');
        Route::delete('/delete', [\App\Http\Controllers\PostController::class, 'delete'])->middleware('role:visitor');
    });
    Route::prefix('/purchase')->group(function () {
        Route::post('/add', [\App\Http\Controllers\PurchaseController::class, 'Add'])->middleware('role:employee');
        Route::put('/edit', [\App\Http\Controllers\PurchaseController::class, 'edit'])->middleware('role:employee');
        Route::get('/view', [\App\Http\Controllers\PurchaseController::class, 'view'])->middleware('role:visitor');
        Route::delete('/delete', [\App\Http\Controllers\PurchaseController::class, 'delete'])->middleware('role:employee');
    });

    });
