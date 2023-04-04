<?php
namespace App\Enum\User; 

enum UserType:string {
    case admin = 'admin'; 
    case user = 'user'; 
}