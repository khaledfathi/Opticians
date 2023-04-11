<?php
namespace App\Enum\User; 

enum UserStatus : string {
    case ACTIVE = 'active'; 
    case CLOSED = 'closed'; 
}