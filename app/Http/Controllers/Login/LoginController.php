<?php
namespace App\Http\Controllers\Login;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function loginPage(){
        return view('login.login'); 
    }
    public function login(Request $request){
        if ( Auth::attempt(['name'=>$request->name , 'password'=>$request->password]) ){
            return redirect('search');
        }
        return redirect('login'); 
    }
    public function logout(){
        Auth::logout(); 
        return redirect('/'); 
    }
}
