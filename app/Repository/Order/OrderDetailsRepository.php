<?php 
namespace App\Repository\Order;
use App\Models\OrderDetailsModel;
use App\Repository\Contracts\Order\OrderDetailsRepositoryContract;

class OrderDetailsRepository implements OrderDetailsRepositoryContract{
    function index ():object
    {
        return OrderDetailsModel::get(); 
    }
    function store(array $data):OrderDetailsModel
    {
        return OrderDetailsModel::create($data); 
    }
}