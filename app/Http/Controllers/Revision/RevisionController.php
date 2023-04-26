<?php

namespace App\Http\Controllers\Revision;

use App\Http\Controllers\Controller;
use App\Repository\Contracts\Order\OrderDetailsRepositoryContract;
use App\Repository\Contracts\Order\OrderRepositoryContract;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class RevisionController extends Controller
{
    private $orderProvider ; 
    private $orderDetailsProvider; 
    public function __construct(
        OrderRepositoryContract $orderProvider,
        OrderDetailsRepositoryContract $orderDetailsProvider
    )
    {
        $this->orderProvider = $orderProvider; 
        $this->orderDetailsProvider = $orderDetailsProvider;
    }
    public function indexRevision(){
        $currentDate= Carbon::now()->timezone('Africa/Cairo')->format('y-m-d');
        $orders = $this->orderProvider->showByDate($currentDate);
        $ordersCount= $orders->count();     
        return view('revision.revision' , [
            'orders'=>$orders ,
            'ordersCount'=>$ordersCount,
            ]);
    }
    public function showInDate(Request $request){
        $orders = $this->orderProvider->showByDate($request->date);
        $ordersCount= $orders->count();
        return view('revision.revision' , [
            'orders'=>$orders ,
            'ordersCount'=>$ordersCount,
            ]);
    }
    public function showOrder(Request $request){
        $order = $this->orderProvider->show($request->id);
        $orderDetails = $this->orderDetailsProvider->showByOrderId($request->id);
        return view('revision.showOrder' , [
            'orderDetails'=>$orderDetails,
            'order'=>$order
        ]); 
    }
    public function destroyOrder(Request $request){
        //delete order image file 
        $order = $this->orderProvider->show($request->id);
        if ($order){
            File::delete(public_path($order->image)); 

            //delete order works images files
            $orderWorks = $this->orderDetailsProvider->showByOrderId($request->id);
            if ($orderWorks->count()){
                foreach($orderWorks as $work){
                    if ($work->work_image) {
                        File::delete(public_path($work->work_image)); 
                    };
                }
            }
            //delete order record and its childrens (order details)
            $this->orderProvider->destroy($request->id);
        }
        return response()->json(['ok'=>true , 'msg'=>'تم حذف امر الشغل']); 
    }
    public function setRevisionSingleOrder(Request $request){
        $data=[
            'revision'=>true,
            'revisioner'=>auth()->user()->name,
            //subtract 1 from required to revision order/work 
            'required_revision_count'=>$this->orderProvider->show($request->id)->required_revision_count-1
        ];
        $updated = $this->orderProvider->update($data , $request->id); 
        return response()->json(['revision'=>true , 'revisioner'=>auth()->user()->name]); 
    }
    public function setRevisionMultiOrder(Request $request){
        $orderData=[
            //subtract 1 from required to revision order/work 
            'required_revision_count'=>$this->orderProvider->show($request->order_id)->required_revision_count-1
        ];
        $workData=[
            'revision'=>true,
            'revisioner'=>auth()->user()->name,
        ];
        $this->orderProvider->update($orderData , $request->order_id); 
        $this->orderDetailsProvider->update($workData , $request->work_id); 
        return response()->json(['revision'=>true , 'revisioner'=>auth()->user()->name]); 
    }
}
