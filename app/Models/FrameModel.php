<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FrameModel extends Model
{
    use HasFactory;
    public $table= 'frames'; 
    protected $fillable = [
        'name', 
        'description'
    ]; 
}
