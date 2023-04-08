<?php

namespace App\Http\Controllers\Profile;

use App\Enum\User\UserStatus;
use App\Enum\User\UserType;
use App\Http\Controllers\Controller;
use App\Repository\Contracts\User\UserRepositoryContract;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    private $userProvider ; 
    public function __construct(
        UserRepositoryContract $userProvider
    )
    {
        $this->userProvider = $userProvider ; 
    }

    public function indexProfile(){
        $userStatus = UserStatus::cases(); 
        $usrTypes = UserType::cases(); 
        $record = $this->userProvider->show(auth()->user()->id); 
        $record = ($record->count()) ? $record : null ; 
        return view('profile.profile' , ['userStatus' =>$userStatus , 'userTypes'=>$usrTypes , 'record'=>$record]); 
    }
    public function updateProfile(){
        return "updated"; 
    }
}
