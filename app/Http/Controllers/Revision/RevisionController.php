<?php

namespace App\Http\Controllers\Revision;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RevisionController extends Controller
{
    public function indexRevision(){
        return view('revision.revision'); 
    }
}
