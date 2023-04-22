<?php 
namespace App\Enum\Order;

enum OrderTypes : string {
    case MAINTENANCE = 'صيانة' ; 
    case NEW = 'تصنيع';
}
