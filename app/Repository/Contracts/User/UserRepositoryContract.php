<?php 
namespace App\Repository\Contracts\User;
use App\Models\User as UserModel; 


interface UserRepositoryContract {
    public function store(array $record):UserModel; 
    public function index():object; 
    public function destroy(int $id):bool; 
    public function show (int $id):object; 
}