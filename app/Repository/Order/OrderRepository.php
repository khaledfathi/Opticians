<?php 
namespace App\Repository\Order;
use App\Models\OrderModel;
use App\Repository\Contracts\Order\OrderRepositoryContract; 

class OrderRepository implements OrderRepositoryContract{
    function index ():object
    {
        return OrderModel::get(); 
    }
}