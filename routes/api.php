<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\CompanyController;
use App\Http\Controllers\API\DeparmentController;
use App\Http\Controllers\API\CardtypeController;
use App\Http\Controllers\API\CardpriceController;
use App\Http\Controllers\API\EmployeeController;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::post('register',[UserController::class,'register']);
Route::post('login',[UserController::class,'login']);
Route::get('logout',[UserController::class,'logout']);

Route::group(["middleware"=>["auth:api"]],
    function(){
        Route::post('testjwt',[UserController::class,'testjwt']);
    }
);

//Comp
Route::group(["middleware"=>["auth:api"]],
    function(){
        Route::get('comp',[CompanyController::class,'index']);
        Route::post('comp/add',[CompanyController::class,'add']);
        Route::get('comp/edit/{id}',[CompanyController::class,'edit']);
        Route::post('comp/update/{id}',[CompanyController::class,'update']);
        Route::delete('comp/delete/{id}',[CompanyController::class,'delete']);
    }
);

//Dep
Route::group(["middleware"=>["auth:api"]],
    function(){
        Route::get('dep',[DeparmentController::class,'index']);
        Route::post('dep/add',[DeparmentController::class,'add']);
        Route::get('dep/edit/{id}',[DeparmentController::class,'edit']);
        Route::post('dep/update/{id}',[DeparmentController::class,'update']);
        Route::delete('dep/delete/{id}',[DeparmentController::class,'delete']);
    }
);

//CardType
Route::group(["middleware"=>["auth:api"]],
    function(){
        Route::get('cardtype',[CardtypeController::class,'index']);
        Route::post('cardtype/add',[CardtypeController::class,'add']);
        Route::get('cardtype/edit/{id}',[CardtypeController::class,'edit']);
        Route::post('cardtype/update/{id}',[CardtypeController::class,'update']);
        Route::delete('cardtype/delete/{id}',[CardtypeController::class,'delete']);
    }
);

//Cardprice
Route::group(["middleware"=>["auth:api"]],
    function(){
        Route::get('cardprice',[CardpriceController::class,'index']);
        Route::post('cardprice/add',[CardpriceController::class,'add']);
        Route::get('cardprice/edit/{id}',[CardpriceController::class,'edit']);
        Route::post('cardprice/update/{id}',[CardpriceController::class,'update']);
        Route::delete('cardprice/delete/{id}',[CardpriceController::class,'delete']);
    }
);

//Employee
Route::group(["middleware"=>["auth:api"]],
    function(){
        Route::get('emp',[EmployeeController::class,'index']);
        Route::post('emp/add',[EmployeeController::class,'add']);
        Route::get('emp/edit/{id}',[EmployeeController::class,'edit']);
        Route::post('emp/update/{id}',[EmployeeController::class,'update']);
        Route::delete('emp/delete/{id}',[EmployeeController::class,'delete']);
    }
);