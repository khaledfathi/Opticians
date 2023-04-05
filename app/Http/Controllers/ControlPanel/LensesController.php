<?php

namespace App\Http\Controllers\ControlPanel;

use App\Http\Controllers\Controller;
use App\Http\Requests\CPanel\Lens\NewLensRequest;
use App\Repository\Contracts\Lens\LensRepositoryContract;
use Illuminate\Http\Request;

class LensesController extends Controller
{
    private $lensProvider ; 
    public function __construct(
        LensRepositoryContract $lensProvider
    )
    {
        $this->lensProvider = $lensProvider; 
    }
    public function lensesPage(){
        $records = $this->lensProvider->index(); 
        $records = ($records->count()) ? $records : null ; 
        return view('cpanel.lenses.lenses', ['records'=>$records]); 
    }
    public function newLensPage(){
        return view('cpanel.lenses.newLens'); 
    }
    public function storeLens(NewLensRequest $request){ 
        $this->lensProvider->store($request->except('__token')); 
        return redirect('cpanel/lenses'); 
    }
    public function deleteLens(Request $request){
        $this->lensProvider->destroy($request->id); 
        return redirect('cpanel/lenses'); 
    }

}
