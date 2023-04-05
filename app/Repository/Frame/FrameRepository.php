<?php 
namespace App\Repository\Frame;
use App\Models\FrameModel;
use App\Repository\Contracts\Frame\FrameRepositoryContract; 

class FrameRepository implements FrameRepositoryContract{
    public function store(array $data):FrameModel
    {
        return FrameModel::create($data); 
    }
    public function index():object
    {
        return FrameModel::get(); 
    }
    public function destroy(int $id):bool 
    {
        $found = FrameModel::find($id); 
        return ($found) ? $found->delete() : false ; 
    }
}