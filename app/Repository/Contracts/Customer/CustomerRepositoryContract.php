<?php 
namespace App\Repository\Contracts\Customer;
use App\Models\CustomerModel; 


interface CustomerRepositoryContract {
    public function store(array $record):CustomerModel; 
    public function index():object;
    public function destroy(int $id):bool;  
    public function show (int $id):object; 
    public function update (array $data , int $id ):bool ; 
}