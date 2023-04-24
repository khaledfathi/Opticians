<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetailsModel extends Model
{
    use HasFactory;    
    public $table = 'order_details';
    protected $fillable = [
        'r_sphere', 
        'r_cylinder', 
        'r_axis', 
        'r_add', 
        'l_sphere', 
        'l_cylinder', 
        'l_axis', 
        'l_add', 
        'count', 
        'image',
        'revision',
        'revisioner',
        'details', 
        //Fk
        'order_id',
        'frame_id', 
        'lens_id'
    ]; 
}
