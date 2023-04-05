<?php 
namespace App\Repository\Customer; 

use App\Models\CustomerModel;
use App\Repository\Contracts\Customer\CustomerRepositoryContract;

class CustomerRepository implements CustomerRepositoryContract{
    public function store(array $record):CustomerModel
    {
        return CustomerModel::create($record);
    }
    public function index():object
    {
        return CustomerModel::get(); 
    }
    public function destroy(int $id):bool
    {
        $found = CustomerModel::find($id); 
        return ($found) ? $found->delete() : false ; 
    }
}