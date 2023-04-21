<?php 
namespace App\Repository\Contracts\Order;
use App\Models\OrderModel;

interface OrderRepositoryContract {    
    function index():object; 
    function store(array $data):OrderModel; 
}