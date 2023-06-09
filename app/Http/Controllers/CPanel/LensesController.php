<?php

namespace App\Http\Controllers\CPanel;

use App\Http\Controllers\Controller;
use App\Http\Requests\CPanel\Lens\CreateLensRequest;
use App\Http\Requests\CPanel\Lens\UpdateLensRequest;
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
    public function indexLens(){
        $records = $this->lensProvider->index(); 
        $records = ($records->count()) ? $records : null ; 
        return view('cpanel.lenses.lenses', ['records'=>$records]); 
    }
    public function createLens(){
        return view('cpanel.lenses.createLens'); 
    }
    public function storeLens(CreateLensRequest $request){ 
        $record = $this->lensProvider->store($request->except('__token')); 
        return redirect('cp/lenses')->with(['ok'=> "تم حفظ عدسة - $record->name"]); 
    }
    public function destroyLens(Request $request){
        try {
            $this->lensProvider->destroy((int)$request->id); 
        } catch (\Illuminate\Database\QueryException $e) {
            return response()->json(['ok'=>false , 'msg'=>'العدسة مستخدمة فى اوامر الشغل - احذف اوامر الشغل اولاً']); 
}
        // $this->lensProvider->destroy((int)$request->id); 
        return response()->json(['ok'=>true , 'msg'=>'تم حذف العدسىة']); 
    }
    public function editLens(Request $request){
        $record = $this->lensProvider->show($request->id); 
        return view('cpanel.lenses.editLens' , ['record'=>$record]);
    }
    public function updateLens(UpdateLensRequest $request){
        $this->lensProvider->update($request->except('_token') , $request->id); 
        return redirect('cp/lenses')->with(['ok'=>"تم تحديث العدسة - $request->name"]); 
    }

}
