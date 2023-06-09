<?php

namespace App\Http\Controllers\Order;

use App\Enum\Order\OrderTypes;
use App\Http\Controllers\Controller;
use App\Http\Requests\Order\CreateOrderRequest;
use App\Http\Requests\Order\CreateOrderRequest as UpdateOrderRequest;
use App\Repository\Contracts\Customer\CustomerRepositoryContract;
use App\Repository\Contracts\Frame\FrameRepositoryContract;
use App\Repository\Contracts\Lens\LensRepositoryContract;
use App\Repository\Contracts\Order\OrderDetailsRepositoryContract;
use App\Repository\Contracts\Order\OrderRepositoryContract;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class OrderController extends Controller
{
    private $orderProvider ; 
    private $orderDetailsProvider; 
    private $customerProvider; 
    private $frameProvider; 
    private $lensProvider; 
    function __construct(
        OrderRepositoryContract $orderProvider,
        OrderDetailsRepositoryContract $orderDetailsProvider,
        CustomerRepositoryContract $customerProvider, 
        FrameRepositoryContract $frameProvider,
        LensRepositoryContract $lensProvider 
    )
    {
        $this->orderProvider = $orderProvider;
        $this->orderDetailsProvider = $orderDetailsProvider;
        $this->customerProvider = $customerProvider;
        $this->frameProvider = $frameProvider;
        $this->lensProvider = $lensProvider;
    }
    public function indexOrder(){
        $customers = $this->customerProvider->index(); 
        $frames = $this->frameProvider->index(); 
        $lenses = $this->lensProvider->index();
        return view('order.order', [
            'customers'=>$customers,
            'frames'=>$frames,
            'lenses'=>$lenses,
            'orderTypes'=> OrderTypes::cases()
        ]);  
    }
    function validateOrderDetails(array $orderDetails){
        $errors=[]; 
        //validate lens
        foreach($orderDetails as $work){
            //validate axis depend on axis
            if(
                $work->l_cylinder && ! $work->l_axis||
                $work->r_cylinder && ! $work->r_axis
            ){
                $errors['axis']='one or more cylinder has value so axis is required !';
            }
            //validate lens type
            (!$this->lensProvider->isExist($work->lensTypeId)) ? $errors['lens']='invalid one or more lens type !' : null;
            //validate frame type
            (!$this->frameProvider->isExist($work->frameTypeId)) ? $errors['frame']='invalid one or more frame type' : null;
        }
        return $errors;
    }
    public function storeOrder(CreateOrderRequest $request){            
        //validate order details
        $validateOrderDetails = $this->validateOrderDetails(json_decode($request->order_details)); 

        if (!$validateOrderDetails){//if no errors
            //preparing date
            $works_count = count(json_decode($request->order_details));            
            $orderData = [
                'date'=>$request->date,
                'time'=>$request->time,
                'delivery_date'=>$request->delivery_date,
                'type'=>$request->work_type,
                'works_count'=> ($works_count) ? $works_count : 1,//works count
                'required_revision_count'=> ($works_count) ? $works_count : 1,//same as  works count
                'details'=>$request->details,
                //FK
                'customer_id'=>$request->customer_id,
                'user_id'=>auth()->user()->id
            ]; 

            // store order image
            if ($request->image){
                $file = $request->file('image'); 
                $directory = '/assets/upload/ordersImage'; 
                $fileName=time().'.'.$file->getClientOriginalExtension(); 
                $filePath = $directory.'/'.$fileName;
                $file->move(public_path().$directory , $fileName);
                $orderData['image']=$filePath;
            }
            //store order
            $order = $this->orderProvider->store($orderData);
            
            //order details
            $orderDetails = json_decode($request->order_details) ;
            if ($orderDetails){
                foreach($orderDetails as $work){
                    //preparing date
                    $workData=[
                        'count'=>$work->count,
                        'revision'=>false,
                        'details'=>$work->details,
                        // FK
                        'order_id'=>$order->id,
                        'frame_id'=>$work->frameTypeId,
                        'lens_id'=>$work->lensTypeId
                    ];
                    ($work->r_sphere) ? $workData['r_sphere']= $work->r_sphere : null;
                    ($work->r_cylinder) ? $workData['r_cylinder']= $work->r_cylinder : null;
                    ($work->r_axis) ? $workData['r_axis']= $work->r_axis : null;
                    ($work->r_add) ? $workData['r_add']= $work->r_add : null;
                    ($work->l_sphere) ? $workData['l_sphere']= $work->l_sphere : null;
                    ($work->l_cylinder) ? $workData['l_cylinder']= $work->l_cylinder : null;
                    ($work->l_axis) ? $workData['l_axis']= $work->l_axis : null;
                    ($work->l_add) ? $workData['l_add']= $work->l_add : null;

                    //store order detail image                    
                    $imageName = $work->image;
                    if ( isset(((array)$request->all())[$work->image]) ){
                        $file = $request->file($imageName);                         
                        $dirPath = '/assets/upload/ordersImage/';
                        $fileName= rand(1,999).'_'.time().'.'.$file->getClientOriginalExtension();
                        $file->move(public_path().$dirPath ,$fileName);                        
                        $workData['image']= $dirPath.$fileName;
                    };

                    //store order detail
                    $this->orderDetailsProvider->store($workData); 
                }
            }
        }else {
            return redirect('order')->withErrors($validateOrderDetails); 
        }
        return redirect('order')->with(['ok'=>'تم تسجيل امر شغل']); 
    }
    public function editOrder(Request $request){
        $order = $this->orderProvider->show($request->id);
        $works = $this->orderDetailsProvider->showByOrderId($request->id); 
        $works  = ($works->count()) ? $works : null ; 
        $customers = $this->customerProvider->index(); 
        $frames = $this->frameProvider->index(); 
        $lenses = $this->lensProvider->index(); 
        return view('order.editOrder', [
            'order'=>$order,
            'works'=>$works,
            'customers'=>$customers,
            'frames'=>$frames,
            'lenses'=>$lenses,
            'orderTypes'=> OrderTypes::cases()
        ]);  
    }
    public function updateOrder(UpdateOrderRequest $request){
        $record = $this->orderProvider->show($request->id); 
        if ($request->work_type == 'صيانة'){
            $orderData=[
                'date' => $request->date, 
                'time' => $request->time,
                'customer_id'=>$request->customer_id,
                'delivery_date' => $request->delivery_date, 
                'required_revision_count' => ($request->order_revision_status) ? 1 : 1 , //return revision count to 1 if revision is canceled
                'details'=> $request->details,
                'revision'=> $request->order_revision_status,
                'user_id'=>auth()->user()->id
            ]; 
            //order image 
            if ($request->has('image')){
                // store new image
                $file = $request->file('image'); 
                $directory = '/assets/upload/ordersImage'; 
                $fileName=time().'.'.$file->getClientOriginalExtension(); 
                $filePath = $directory.'/'.$fileName;
                $file->move(public_path().$directory , $fileName);
                $orderData['image']=$filePath;
                //delete old image if exist
                ($record->image) ? File::delete(public_path($record->image)) : null ; 
            }else if ($request->delete_order_image_status){
                if ($record->image) {
                    File::delete(public_path($record->image)); 
                    $orderData['image']=null; 
                }
            }
            //update order in database
            $this->orderProvider->update($orderData, $request->id);
            return back();

        }else if ($request->work_type == 'نظارة جديدة'){
            //validate order details
            $validateOrderDetails = $this->validateOrderDetails(json_decode($request->order_details)); 
            
            if (!$validateOrderDetails){//if no errors
                //preparing date
                $works_count = count(json_decode($request->order_details));
                //order data
                $orderData = [
                    'date'=>$request->date,
                    'time'=>$request->time,
                    'delivery_date'=>$request->delivery_date,
                    'details'=>$request->details,
                    //FK
                    'customer_id'=>$request->customer_id,
                    'user_id'=>auth()->user()->id
                ]; 
                       
                //order details
                $orderDetails = json_decode($request->order_details) ;
                $revisionCount = 0 ; 
                $worksCount=0; 
                if ($orderDetails){          
                    foreach($orderDetails as $work){
                        //get current image for this work (from order_details table)
                        $oldImagePath = $this->orderDetailsProvider->show($work->id)['image']; 
                        if ($work->deleteStatus){
                            //delete this work
                            $this->orderDetailsProvider->destroy($work->id); 
                            File::delete(public_path($oldImagePath)); 
                            continue; 
                        }
                        //preparing date
                        $workData=[
                            'count'=>$work->count,
                            'revision'=>$work->revision,
                            'details'=>$work->details,
                            // FK
                            'order_id'=>$request->id,
                            'frame_id'=>$work->frameTypeId,
                            'lens_id'=>$work->lensTypeId
                        ];
                        ($work->r_sphere) ? $workData['r_sphere']= $work->r_sphere : null;
                        ($work->r_cylinder) ? $workData['r_cylinder']= $work->r_cylinder : null;
                        ($work->r_axis) ? $workData['r_axis']= $work->r_axis : null;
                        ($work->r_add) ? $workData['r_add']= $work->r_add : null;
                        ($work->l_sphere) ? $workData['l_sphere']= $work->l_sphere : null;
                        ($work->l_cylinder) ? $workData['l_cylinder']= $work->l_cylinder : null;
                        ($work->l_axis) ? $workData['l_axis']= $work->l_axis : null;
                        ($work->l_add) ? $workData['l_add']= $work->l_add : null;
                        
                        //update work image 
                        //delete old image
                        
                        //current image
                        $imageName = $work->image;
                        if ( isset(((array)$request->all())[$work->image]) ){
                            //store new image
                            $file = $request->file($imageName);                         
                            $dirPath = '/assets/upload/ordersImage/';
                            $fileName= rand(1,999).'_'.time().'.'.$file->getClientOriginalExtension();
                            $file->move(public_path().$dirPath ,$fileName);                        
                            $workData['image']= $dirPath.$fileName;
                            //delete old image 
                            File::delete(public_path($oldImagePath)); 
                        }else if ($work->deleteImageStatus){
                             $workData['image']= null;
                            //delete old image 
                            File::delete(public_path($oldImagePath)); 
                        }


                        //calculate revision count for order table 
                        ($work->revision) ? $revisionCount+=1 : null ; 
                        $worksCount+=1; 

                        //update order detail
                        $this->orderDetailsProvider->update($workData , $work->id); 
                    }
                    $orderData['works_count']=$worksCount; 
                    $orderData['required_revision_count']=$worksCount - $revisionCount; 
                    //update order
                    $order = $this->orderProvider->update($orderData , $request->id);
               }
            }else {
                return redirect('order')->withErrors($validateOrderDetails); 
            }
            return back(); 

        }
        
    }
}
