<?php

use App\Http\Controllers\ControlPanel\ControlPanelController;
use App\Http\Controllers\ControlPanel\UserManagementController;
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

    //search controller
    Route::get('search' , [SearchController::class , 'searchPage']);

    //control panel controller
    Route::group(['prefix'=>'cpanel'],function (){
        Route::get('/' ,[ ControlPanelController::class , 'controlPanelPage']);
        Route::group(['prefix'=>'usersmanagment'],function (){
            Route::get('/' ,[ UserManagementController::class , 'usersManagmentPage']);
            Route::get('newuser' ,[ UserManagementController::class , 'newUserPage']);
            Route::post('createuser', [UserManagementController::class , 'createUser']); 
            Route::get('deleteuser/{id}' , [UserManagementController::class , 'deleteUser']); 
        });

    }); 
});