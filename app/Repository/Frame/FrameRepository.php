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
    public function isExist (int $id):bool 
    {
        return (FrameModel::find($id)) ? true : false; 
    }
    public function show (int $id):object 
    {
        return FrameModel::where('id' , $id)->first(); 
    }
    public function update(array $data , int $id):bool
    {
        $found = FrameModel::find($id); 
        return ($found)? $found->update($data) : false ; 
    }
}