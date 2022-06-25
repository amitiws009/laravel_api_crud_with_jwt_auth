<?php


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\DepartmentController;

Route::post('login', [ApiController::class, 'authenticate']);
Route::post('register', [ApiController::class, 'register']);
Route::group(['middleware' => ['jwt.verify']], function() {
    Route::get('logout', [ApiController::class, 'logout']);
    Route::get('get_user', [ApiController::class, 'get_user']);
    Route::get('department/{id}', [DepartmentController::class, 'show']);
    Route::post('department/create', [DepartmentController::class, 'store']);
    Route::put('department/update/{departmen}',  [DepartmentController::class, 'update']);
    Route::delete('department/delete/{departmen}',  [DepartmentController::class, 'destroy']);
});