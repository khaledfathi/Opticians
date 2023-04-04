<?php

namespace App\Http\Controllers\ControlPanel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ControlPanelController extends Controller
{
    public function controlPanelPage(){
        return view('cpanel.cpanel'); 
    }
}
