<?php

namespace App\Http\Controllers\ControlPanel;

use App\Http\Controllers\Controller;
use App\Http\Requests\CPanel\UsersManagment\NewUserRequest;
use App\Repository\Contracts\User\UserRepositoryContract;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserManagementController extends Controller
{
    private $userProvider; 
    public function __construct(
        UserRepositoryContract $userProvider
    )
    {
        $this->userProvider = $userProvider; 
    }
    public function usersManagmentPage(){
        $records= $this->userProvider->show(); 
        $records = ($records->count()) ? $records : null ; 
        return view('cpanel.usersManagment.usersManagment' , ['records'=>$records]);
    }
    public function newUserPage(){
        return view('cpanel.usersManagment.newUser');
    }
    public function createUser(NewUserRequest $request){
        //prepare request 
        $request = $request->except(['_token', 'password_confirmation']); 
        $request["password"] = Hash::make($request["password"]); 

        $record = $this->userProvider->create($request);
        return redirect('cpanel/usersmanagment')->with(['ok'=>'تم اضافة المستخدم '.$record->name]); 
    }
    public function deleteUser(Request $request){
        if ($request->id == auth()->user()->id) return back()->withErrors('لايمكن حذف نفسك !'); 
        $this->userProvider->destroy((int)$request->id); 
        return back()->with(['ok'=>'تم حذف المستخدم']); 
    }
}
