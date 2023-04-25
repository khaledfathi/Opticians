<?php 
namespace App\Repository\Contracts\Order;
use App\Models\OrderModel;

interface OrderRepositoryContract {    
    public function index():object; 
    public function store(array $data):OrderModel; 
    public function show(string $id):null|object;
    public function showByDate(string $date):object;
    public function destroy(int $id):bool; 
    public function update(array $data , int $id):bool;
}