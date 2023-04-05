<?php

namespace App\Http\Controllers\ControlPanel;

use App\Enum\User\UserStatus;
use App\Enum\User\UserType;
use App\Http\Controllers\Controller;
use App\Http\Requests\CPanel\User\NewUserRequest;
use App\Repository\Contracts\User\UserRepositoryContract;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    private $userProvider; 
    public function __construct(
        UserRepositoryContract $userProvider
    )
    {
        $this->userProvider = $userProvider; 
    }
    public function usersManagmentPage(){
        $records= $this->userProvider->index(); 
        $records = ($records->count()) ? $records : null ; 
        return view('cpanel.users.users' , ['records'=>$records]);
    }
    public function newUserPage(){
        return view('cpanel.users.newUser' , ['userTypes'=>UserType::cases(), 'userStatus'=>UserStatus::cases()] );
    }
    public function storeUser(NewUserRequest $request){        
        //prepare request 
        $data = $request->except(['_token', 'password_confirmation']); 
        $data["password"] = Hash::make($request["password"]); 

        $record = $this->userProvider->store($data);
        return redirect('cpanel/users')->with(['ok'=>'تم اضافة المستخدم '.$record->name]); 
    }
    public function deleteUser(Request $request){
        if ($request->id == auth()->user()->id) return redirect('cpanel/users')->withErrors('لايمكن حذف نفسك !'); 
        $this->userProvider->destroy((int)$request->id); 
        return redirect('cpanel/users')->with(['ok'=>'تم حذف المستخدم']); 
    }
}
