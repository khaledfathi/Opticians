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
        'required_revision_count',
        'details',
        'revision',
        'revisioner', 
        //FK
        'user_id', 
        'customer_id',         
    ]; 
}
