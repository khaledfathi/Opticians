<?php

namespace App\Http\Controllers\CPanel;

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
    public function indexFrame(){
        $records = $this->frameProvider->index(); 
        $records = ($records->count()) ? $records : null ; 
        return view('cpanel.frames.frames', ['records'=>$records]);
    }
    public function createFrame(){
        return view('cpanel.frames.newFrame');
    }
    public function storeFrame(NewFrameRequest $request){
        $this->frameProvider->store($request->except('_token')); 
        return redirect('cpanel/frames'); 
    }
    public function destroyFrame(Request $request){
        $this->frameProvider->destroy((int)$request->id); 
        return response()->json(['ok'=>true , 'msg'=>'تم حذف الفريم']); 
}
}
