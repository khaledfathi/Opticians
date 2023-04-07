<?php

namespace App\Http\Controllers\CPanel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CPanelController extends Controller
{
    public function indexCpanel(){
        return view('cpanel.cpanel'); 
    }
}
