<?php 
namespace App\Repository\Order;
use App\Models\OrderDetailsModel;
use App\Repository\Contracts\Order\OrderDetailsRepositoryContract;

class OrderDetailsRepository implements OrderDetailsRepositoryContract{
    public function index ():object
    {
        return OrderDetailsModel::get(); 
    }
    public function store(array $data):OrderDetailsModel
    {
        return OrderDetailsModel::create($data); 
    }
    public function show(int $id):object
    {
        return OrderDetailsModel::where('id' , $id)->get()->first(); 
    }
    public function showByOrderId(int $orderId):object
    {
        return OrderDetailsModel::leftJoin('lenses' , 'lenses.id' , '=' , 'order_details.lens_id')->
            leftJoin('frames' , 'frames.id' , '=' , 'order_details.frame_id')->
            where('order_details.order_id' , $orderId)->
            select(
                'order_details.id',
                'order_details.l_sphere',
                'order_details.l_cylinder',
                'order_details.l_axis',
                'order_details.l_add',
                'order_details.r_sphere',
                'order_details.r_cylinder',
                'order_details.r_axis',
                'order_details.r_add',
                'order_details.details',
                'order_details.image as work_image',
                'order_details.count',
                'order_details.revision',
                'order_details.revisioner',
                'frames.name as frame_name',
                'lenses.name as lens_name',
            )->get();
    }
    public function update (array $data , int $id): bool 
    {
        $found = OrderDetailsModel::find($id); 
        return ($found) ? $found->update($data) : false; 
    }
}