<?php 
namespace App\Repository\Contracts\Order;
use App\Models\OrderDetailsModel;

interface OrderDetailsRepositoryContract {    
    public function index():object; 
    public function store(array $data):OrderDetailsModel; 
    public function showByOrderId(int $orderId):object; 
}