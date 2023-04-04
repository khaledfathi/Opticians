<?php 
namespace App\Repository\User; 

use App\Models\User as UserModel;
use App\Repository\Contracts\User\UserRepositoryContract;

class UserRepository implements UserRepositoryContract{
    public function create(array $record):UserModel
    {
        return UserModel::create($record);
    }
    public function show():object
    {
        return UserModel::get();      
    }
    public function destroy(int $id):bool
    {
        $found = UserModel::find($id); 
        return ($found) ? $found->delete() : false ; 
    }
}