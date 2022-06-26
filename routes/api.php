<?php


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\EmployeedetailController;

Route::post('login', [ApiController::class, 'authenticate']);
Route::post('register', [ApiController::class, 'register']);
Route::group(['middleware' => ['jwt.verify']], function() {
    Route::get('logout', [ApiController::class, 'logout']);
    Route::get('get_user', [ApiController::class, 'get_user']);

    Route::get('department/{id}', [DepartmentController::class, 'show']);
    Route::post('department/create', [DepartmentController::class, 'store']);
    Route::put('department/update/{departmen}',  [DepartmentController::class, 'update']);
    Route::delete('department/delete/{departmen}',  [DepartmentController::class, 'destroy']);

    Route::get('employee/{id}', [EmployeeController::class, 'show']);
    Route::post('employee/create', [EmployeeController::class, 'store']);
    Route::put('employee/update/{employee}',  [EmployeeController::class, 'update']);
    Route::delete('employee/delete/{employee}',  [EmployeeController::class, 'destroy']);

    Route::get('employeedetail/{id}', [EmployeedetailController::class, 'show']);
    Route::post('employeedetail/create', [EmployeedetailController::class, 'store']);
    Route::put('employeedetail/update/{employee}',  [EmployeedetailController::class, 'update']);
    Route::delete('employeedetail/delete/{employee}',  [EmployeedetailController::class, 'destroy']);
});