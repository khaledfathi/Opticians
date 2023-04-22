<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderModel extends Model
{
    use HasFactory;
    public $table = 'orders'; 
    protected $fillable = [        
        'date',
        'time',
        'delivery_date',
        'image',
        'type',
        'works_count',
        'details',
        //FK
        'user_id', 
        'customer_id',         
    ]; 
}
