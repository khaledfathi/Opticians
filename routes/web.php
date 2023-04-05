<?php

use App\Http\Controllers\ControlPanel\ControlPanelController;
use App\Http\Controllers\ControlPanel\CustomerController;
use App\Http\Controllers\ControlPanel\FrameController;
use App\Http\Controllers\ControlPanel\LensesController;
use App\Http\Controllers\ControlPanel\UserController;
use App\Http\Controllers\Login\LoginController;
use App\Http\Controllers\Search\SearchController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/' , fn()=>redirect('login')); 
Route::get('login' , [LoginController::class , 'loginPage'])->middleware('guest')->name('login');
Route::post('login' , [LoginController::class , 'login']);


Route::middleware(['auth'])->group(function (){

    Route::get('logout' , [LoginController::class , 'logout']);

    //search 
    Route::get('search' , [SearchController::class , 'searchPage']);

    //control panel 
    Route::group(['prefix'=>'cpanel'],function (){        
        Route::get('/' ,[ ControlPanelController::class , 'controlPanelPage']);
        //user managment
        Route::group(['prefix'=>'users'],function (){
            Route::get('/' ,[ UserController::class , 'usersManagmentPage']);
            Route::get('new' ,[ UserController::class , 'newUserPage']);
            Route::post('store', [UserController::class , 'storeUser']); 
            Route::get('delete/{id}' , [UserController::class , 'deleteUser']); 
        });
        //customer managment
        Route::group(['prefix'=>'customers'], function(){
            Route::get('/' , [CustomerController::class , 'customerPage']);
            Route::get('new' , [CustomerController::class , 'newCustomerPage']);
            Route::post('store' , [CustomerController::class , 'storeCustomer']);
            Route::get('delete/{id}' , [CustomerController::class , 'deleteCustomer']);
        });
        //frames table managment
        Route::group(['prefix'=>'frames'],function (){
            Route::get('/' , [FrameController::class , 'framePage']); 
            Route::get('new' , [FrameController::class , 'newFramePage']); 
            Route::get('store' , [FrameController::class , 'storeFrame']); 
            Route::get('delete/{id}' , [FrameController::class , 'deleteFrame']); 
        });
        //lenses table managment
        Route::group(['prefix'=>'lenses'], function (){
            Route::get('/' , [LensesController::class , 'lensesPage']); 
            Route::get('new' , [LensesController::class , 'newLensPage']);
            Route::get('store' , [LensesController::class , 'storeLens']);
            Route::get('delete/{id}' , [LensesController::class , 'deleteLens']);
        });

    }); 
});

Route::get('dd' , function (){
    return dd(session()->all());
}); 