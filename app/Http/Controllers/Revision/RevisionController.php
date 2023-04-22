<?php

namespace App\Http\Controllers\Revision;

use App\Http\Controllers\Controller;
use App\Repository\Contracts\Order\OrderDetailsRepositoryContract;
use App\Repository\Contracts\Order\OrderRepositoryContract;
use Carbon\Carbon;
use Illuminate\Http\Request;

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
}
