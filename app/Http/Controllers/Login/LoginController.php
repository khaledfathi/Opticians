<?php
namespace App\Http\Controllers\Login;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function indexLogin(){
        return view('login.login'); 
    }
    public function login(Request $request){
        if ( Auth::attempt(['name'=>$request->name , 'password'=>$request->password]) ){ 
            if(auth()->user()->status == 'closed'){
                Auth::logout(); 
                return back()->withErrors('الحساب مغلق - يرجى التواصل مع مدير النظام');
            }
            return redirect('revision');
        }
        return redirect('login')->withErrors('خطأ فى الاسم او كلمة المرور'); 
    }
    public function logout(){
        Auth::logout(); 
        return redirect('/'); 
    }
}
