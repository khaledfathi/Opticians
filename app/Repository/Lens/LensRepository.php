<?php 
namespace App\Repository\Lens;
use App\Models\LensModel;
use App\Repository\Contracts\Lens\LensRepositoryContract; 

class LensRepository implements LensRepositoryContract{
    public function store(array $data):LensModel
    {
        return LensModel::create($data); 
    }
    public function index():object
    {
        return LensModel::get(); 
    }
    public function destroy(int $id):bool 
    {
        $found = LensModel::find($id); 
        return ($found) ? $found->delete() : false ; 
    } 
}