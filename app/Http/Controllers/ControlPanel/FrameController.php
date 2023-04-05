<?php

namespace App\Http\Controllers\ControlPanel;

use App\Http\Controllers\Controller;
use App\Http\Requests\CPanel\Frame\NewFrameRequest;
use App\Repository\Contracts\Frame\FrameRepositoryContract;
use Illuminate\Http\Request;

class FrameController extends Controller
{
    private $frameProvider; 
    public function __construct(
        FrameRepositoryContract $frameProvider
    )
    {
        $this->frameProvider = $frameProvider; 
    }
    public function framePage(){
        $records = $this->frameProvider->index(); 
        $records = ($records->count()) ? $records : null ; 
        return view('cpanel.frames.frames', ['records'=>$records]);
    }
    public function newFramePage(){
        return view('cpanel.frames.newFrame');
    }
    public function storeFrame(NewFrameRequest $request){
        $this->frameProvider->store($request->except('_token')); 
        return redirect('cpanel/frames'); 
    }
    public function deleteFrame(Request $request){
        $this->frameProvider->destroy($request->id); 
        return redirect('cpanel/frames')->with(['ok'=>'تم حذف الفريم']); 
    }
}
