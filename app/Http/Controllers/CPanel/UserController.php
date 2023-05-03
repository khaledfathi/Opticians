<?php

namespace App\Http\Controllers\CPanel;

use App\Enum\User\UserStatus;
use App\Enum\User\UserType;
use App\Http\Controllers\Controller;
use App\Http\Requests\CPanel\User\CreateUserRequest;
use App\Http\Requests\CPanel\User\UpdateUserRequest;
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
    public function indexUser(){
        $records= $this->userProvider->index(); 
        $records = ($records->count()) ? $records : null ; 
        return view('cpanel.users.users' , ['records'=>$records]);
    }
    public function createUser(){
        return view('cpanel.users.createUser' , ['userTypes'=>UserType::cases(), 'userStatus'=>UserStatus::cases()] );
    }
    public function storeUser(CreateUserRequest $request){ 
        //prepare request 
        $data = $request->except(['_token', 'password_confirmation']); 
        $data["password"] = Hash::make($request["password"]); 

        $record = $this->userProvider->store($data);
        return redirect('cp/users')->with(['ok'=>'تم اضافة المستخدم '.$record->name]); 
    }
    public function destroyUser(Request $request){
        if ($request->id == auth()->user()->id){
            return response()->json(['ok'=>false , 'msg'=>'لا يمكن حذف نفسك']); 
        } else {
            $this->userProvider->destroy((int)$request->id); 
            return response()->json(['ok'=>true , 'msg'=>'تم حذف المستخدم']); 
        }
    }
    public function editUser(Request $request){
        $record = $this->userProvider->show($request->id); 
        $userTypes = UserType::cases(); 
        $userStatus = UserStatus::cases(); 
        return view('cpanel.users.editUser' , ['record'=>$record, 'userTypes'=>$userTypes , 'userStatus'=>$userStatus]); 
    }
    public function updateUser(UpdateUserRequest $request){ 
        //prevent admin from removing his privileges
        if (auth()->user()->id == $request->id && ( $request->type != 'admin' || $request->status != 'active')){
            return back()->withErrors('لا يمكن تغيير النوع او الحالة لنفسك');
        }
        //preparing data
        $data = [
            'name'=>$request->name,
            'phone'=>$request->phone,
            'type'=>$request->type,
            'status'=>$request->status
        ];
        if ($request->password){
            $data['password'] = Hash::make($request->password);
        }
        $this->userProvider->update($data , $request->id); 
        return redirect('cp/users')->with(['ok'=>"تم تحديث المستخدم - $request->name"]); 
    }
}
