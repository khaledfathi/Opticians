<?php 
namespace App\Repository\Order;
use App\Models\OrderModel;
use App\Repository\Contracts\Order\OrderRepositoryContract; 

class OrderRepository implements OrderRepositoryContract{
    public function index ():object
    {
        return OrderModel::get(); 
    }
    public function showByDate(string $date):object
    {
        return OrderModel::where('date', $date)->leftJoin('customers' , 'customers.id' , '=' , 'orders.customer_id')->
        select(
            'orders.id',
            'orders.date',
            'orders.time',
            'orders.delivery_date',            
            'orders.works_count',
            'orders.details',
            'orders.image',
            'orders.type',
            'customers.name as customer_name'
        )->get();
    }    
    public function store(array $data):OrderModel
    {
        return OrderModel::create($data); 
    }
}