<?php 
namespace App\Repository\Contracts\Order;
use App\Models\OrderDetailsModel;

interface OrderDetailsRepositoryContract {    
    function index():object; 
    function store(array $data):OrderDetailsModel; 
}