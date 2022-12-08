<?php

use App\Http\Controllers\EmployeeController;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//Get list employee
Route::get('/employees', [EmployeeController::class, 'index']);
//Get list Employee with Paginate
Route::get('/employees/list', [EmployeeController::class, 'getlistpaginate']);
//Get employee by id
Route::get('/employee/{id}', [EmployeeController::class, 'show']);
//Put employee
Route::put('/employee/{id}', [EmployeeController::class, 'update']);
///DELETE Employee by ID
Route::delete('/employee/destroy/{id}', [EmployeeController::class, 'destroy']);
//Add Employee
Route::post('/employee/store', [EmployeeController::class, 'store']);
