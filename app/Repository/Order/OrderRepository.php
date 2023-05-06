<?php 
namespace App\Repository\Order;
use App\Models\OrderModel;
use App\Repository\Contracts\Order\OrderRepositoryContract; 

class OrderRepository implements OrderRepositoryContract{
    public function index ():object
    {
        return OrderModel::get(); 
    }
    public function show(string $id):null|object
    {
        return OrderModel::leftJoin('customers' , 'customers.id' , '=' , 'orders.customer_id')->
            where('orders.id' , $id)->
            select(
                'orders.id',
                'orders.date',
                'orders.time',
                'orders.delivery_date',
                'orders.image',
                'orders.type',
                'orders.works_count',
                'orders.details',
                'orders.revision',
                'orders.revisioner',
                'orders.required_revision_count',
                'customers.id as customer_id',
                'customers.name as customer_name'
            )->first(); 
    }
    public function showByDate(string $date):object
    {
        return OrderModel::where('date', $date)->
            leftJoin('customers' , 'customers.id' , '=' , 'orders.customer_id')->
            leftJoin('users' , 'users.id' , '=' , 'orders.user_id')->
            select(
                'orders.id',
                'orders.date',
                'orders.time',
                'orders.delivery_date',            
                'orders.works_count',
                'orders.required_revision_count',
                'orders.details',
                'orders.image',
                'orders.type',
                'customers.name as customer_name',
                'users.name as user_name'
            )->orderBy('orders.time','desc')->orderBy('orders.id' , 'desc')->get();
    }    
    public function store(array $data):OrderModel
    {
        return OrderModel::create($data); 
    }
    public function destroy(int $id):bool
    {
        $found = OrderModel::find($id);
        return ($found) ? $found->delete() : false; 
    }
    public function update(array $data , int $id):bool 
    {
        $found  = OrderModel::find($id);
        return ($found) ? $found->update($data) : false;  
    }
}