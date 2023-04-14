<?php

namespace App\Http\Controllers\CPanel;

use App\Http\Controllers\Controller;
use App\Http\Requests\CPanel\Frame\CreateFrameRequest;
use App\Http\Requests\CPanel\Frame\UpdateFrameRequest;
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
        return view('cpanel.frames.createFrame');
    }
    public function storeFrame(CreateFrameRequest $request){
        $this->frameProvider->store($request->except('_token')); 
        return redirect('cpanel/frames'); 
    }
    public function destroyFrame(Request $request){
        $this->frameProvider->destroy((int)$request->id); 
        return response()->json(['ok'=>true , 'msg'=>'تم حذف الفريم']); 
    }
    public function editFrame (Request $request){ 
        $record = $this->frameProvider->show($request->id); 
        return view("cpanel.frames.editFrame" , ['record'=>$record]); 
    }
    public function updateFrame(UpdateFrameRequest $request){
        $this->frameProvider->update($request->except('_token') , $request->id); 
        return redirect('cpanel/frames')->with(['ok'=>"تم تحديث الفريم - $request->name"]); 
    }
}
