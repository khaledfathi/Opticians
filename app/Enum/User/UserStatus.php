<?php
namespace App\Enum\User; 

enum UserStatus : string {
    case enabled = 'enabled'; 
    case disabled = 'disabled'; 
}