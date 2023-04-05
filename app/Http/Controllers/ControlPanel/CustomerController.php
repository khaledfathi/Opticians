<?php

namespace App\Http\Controllers\ControlPanel;

use App\Http\Controllers\Controller;
use App\Http\Requests\CPanel\Customer\NewCustomerRequest;
use App\Repository\Contracts\Customer\CustomerRepositoryContract;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    private $customerProvider; 
    public function __construct(
        CustomerRepositoryContract $customerProvider
    )
    {
        $this->customerProvider = $customerProvider; 
    }
    public function customerPage(){
        $records =  $this->customerProvider->index(); 
        if (! $records->count()) $records=null ; 
        return view('cpanel.customers.customers' , ['records'=>$records]); 
    }
    public function newCustomerPage(){
        return view('cpanel.customers.newCustomer'); 
    }
    public function storeCustomer(NewCustomerRequest $request){
        $this->customerProvider->store($request->except('_token')); 
        return redirect('cpanel/customers')->with(['ok'=>'تم اضافة العميل']);
    }
    public function deleteCustomer(Request $request){
        $this->customerProvider->destroy($request->id);
        return redirect('cpanel/customers')->with(['ok'=>'تم حذف العميل']); 
    }
}
