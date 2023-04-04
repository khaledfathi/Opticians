<?php 
namespace App\Repository\Contracts\User;
use App\Models\User as UserModel; 


interface UserRepositoryContract {
    public function create(array $record):UserModel; 
    public function show():object; 
    public function destroy(int $id):bool; 
}