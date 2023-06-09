<?php 
namespace App\Repository\User; 

use App\Models\User as UserModel;
use App\Repository\Contracts\User\UserRepositoryContract;

class UserRepository implements UserRepositoryContract{
    public function store(array $record):UserModel
    {
        return UserModel::create($record);
    }
    public function index():object
    {
        return UserModel::get();      
    }
    public function destroy(int $id):bool
    {
        $found = UserModel::find($id); 
        return ($found) ? $found->delete() : false ; 
    }
    public function show (int $id):object
    {
        return UserModel::where('id' , $id)->first() ; 
    } 
    public function update(array $data , int $id):bool
    {
        $found = UserModel::find($id); 
        return ($found) ? $found->update($data) : false ; 
    }
}