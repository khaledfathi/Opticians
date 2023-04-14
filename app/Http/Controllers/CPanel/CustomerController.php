<?php

namespace App\Http\Controllers\CPanel;

use App\Http\Controllers\Controller;
use App\Http\Requests\CPanel\Customer\CreateCustomerRequest;
use App\Http\Requests\CPanel\Customer\UpdateCustomerRequest;
use App\Http\Requests\CPanel\User\CreateUserRequest;
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
    public function indexCustomer(){
        $records =  $this->customerProvider->index(); 
        if (! $records->count()) $records=null ; 
        return view('cpanel.customers.customers' , ['records'=>$records]); 
    }
    public function createCustomer(){
        return view('cpanel.customers.createCustomer'); 
    }
    public function storeCustomer(CreateCustomerRequest $request){
        $this->customerProvider->store($request->except('_token')); 
        return redirect('cpanel/customers')->with(['ok'=>'تم اضافة العميل']);
    }
    public function destroyCustomer(Request $request){
        $this->customerProvider->destroy((int)$request->id); 
        return response()->json(['ok'=>true , 'msg'=>'تم حذف العميل']); 
    }
    public function editCustomer(Request $request)
    {
        $record = $this->customerProvider->show((int)$request->id);
        return view('cpanel.customers.editCustomer' , ['record'=>$record]); 
    }
    public function updateCustomer(UpdateCustomerRequest $request){        
        $this->customerProvider->update($request->except('_token') , $request->id); 
        return redirect('cpanel/customers')->with(['ok'=>"تم تحديث العميل - $request->name"]);
    } 
}
