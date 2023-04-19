<?php

namespace App\Http\Controllers\Order;

use App\Enum\Order\OrderTypes;
use App\Http\Controllers\Controller;
use App\Repository\Contracts\Customer\CustomerRepositoryContract;
use App\Repository\Contracts\Frame\FrameRepositoryContract;
use App\Repository\Contracts\Lens\LensRepositoryContract;
use App\Repository\Contracts\Order\OrderRepositoryContract;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    private $orderProvider ; 
    private $customerProvider; 
    private $frameProvider; 
    private $lensProvider; 
    function __construct(
        OrderRepositoryContract $orderProvider,
        CustomerRepositoryContract $customerProvider, 
        FrameRepositoryContract $frameProvider,
        LensRepositoryContract $lensProvider
    )
    {
        $this->orderProvider = $orderProvider;
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
    public function createOrder(Request $request){
        dd($request->all()); 
    }
}
