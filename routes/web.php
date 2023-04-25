<?php

use App\Http\Controllers\CPanel\CustomerController;
use App\Http\Controllers\CPanel\FrameController;
use App\Http\Controllers\CPanel\LensesController;
use App\Http\Controllers\CPanel\UserController;
use App\Http\Controllers\CPanel\CPanelController;
use App\Http\Controllers\Login\LoginController;
use App\Http\Controllers\Order\OrderController;
use App\Http\Controllers\Profile\ProfileController;
use App\Http\Controllers\Revision\RevisionController;
use App\Http\Controllers\Search\SearchController;
use Illuminate\Http\Request;
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
Route::get('login' , [LoginController::class , 'indexLogin'])->middleware('guest')->name('login');
Route::post('login' , [LoginController::class , 'login']);


Route::middleware(['auth'])->group(function (){

    Route::get('logout' , [LoginController::class , 'logout']);

    //search 
    Route::get('search' , [SearchController::class , 'indexSearch']);

    //control panel 
    Route::group(['prefix'=>'cpanel'],function (){        
        Route::get('/' ,[ CPanelController::class , 'indexCPanel']);
        //user table managment
        Route::group(['prefix'=>'users'],function (){
            Route::get('/' ,[ UserController::class , 'indexUser']);
            Route::get('create' ,[ UserController::class , 'createUser']);
            Route::post('store', [UserController::class , 'storeUser']); 
            Route::get('destroy/{id}' , [UserController::class , 'destroyUser']); 
            Route::get('/{id}' , [UserController::class , 'editUser']); 
            Route::post('update' ,[ UserController::class , 'updateUser']);
        });
        //customer table managment
        Route::group(['prefix'=>'customers'], function(){
            Route::get('/' , [CustomerController::class , 'indexCustomer']);
            Route::get('create' , [CustomerController::class , 'createCustomer']);
            Route::post('store' , [CustomerController::class , 'storeCustomer']);
            Route::get('destroy/{id}' , [CustomerController::class , 'destroyCustomer']);
            Route::get('/{id}' , [CustomerController::class , 'editCustomer']); 
            Route::post('update' ,[ CustomerController::class , 'updateCustomer']);
        });
        //frames table managment
        Route::group(['prefix'=>'frames'],function (){
            Route::get('/' , [FrameController::class , 'indexFrame']); 
            Route::get('create' , [FrameController::class , 'createFrame']); 
            Route::get('store' , [FrameController::class , 'storeFrame']); 
            Route::get('destroy/{id}' , [FrameController::class , 'destroyFrame']); 
            Route::get('/{id}' , [FrameController::class , 'editFrame']); 
            Route::post('update', [FrameController::class , 'updateFrame']); 
        });
        //lenses table managment
        Route::group(['prefix'=>'lenses'], function (){
            Route::get('/' , [LensesController::class , 'indexLens']); 
            Route::get('create' , [LensesController::class , 'createLens']);
            Route::get('store' , [LensesController::class , 'storeLens']);
            Route::get('destroy/{id}' , [LensesController::class , 'destroyLens']);
            Route::get('/{id}' , [LensesController::class , 'editLens']); 
            Route::post('/update' , [LensesController::class, 'updateLens']); 
        });
    }); 

    //user profile 
    Route::group(['prefix'=>'profile'], function (){
        Route::get('/' , [ProfileController::class , 'indexProfile']); 
        Route::post('update' , [ProfileController::class , 'updateProfile']); 
    }); 

    //order 
    Route::group(['prefix'=>'order'], function (){
        Route::get('/' ,[OrderController::class , 'indexOrder']); 
        Route::post('store' , [OrderController::class , 'storeOrder']); 
    }); 

    //revision
    Route::group(['prefix'=>'revision'] , function (){
        Route::get('/' , [RevisionController::class , 'indexRevision']); 
        Route::get('show/{id}' , [RevisionController::class , 'showOrder']);
        Route::get('showindate' , [RevisionController::class , 'showInDate']); 
        Route::get('destroy/{id}' , [RevisionController::class , 'destroyOrder']); 
        Route::get('setrevisionsingleorder' , [RevisionController::class , 'setRevisionSingleOrder']); 
        Route::get('setrevisionmultiorder' , [RevisionController::class , 'setRevisionMultiOrder']); 
    }); 
});


Route::get('dd' , function (){
    return dd(session()->all());
}); 