<?php 
namespace App\Repository\Contracts\Order;
use App\Models\OrderModel;

interface OrderRepositoryContract {    
    public function index():object; 
    public function store(array $data):OrderModel; 
    public function showByDate(string $date):object;
}