<?php 
namespace App\Repository\Contracts\Lens;
use App\Models\LensModel; 

interface LensRepositoryContract{
    public function store(array $data):LensModel; 
    public function index():object; 
    public function destroy(int $id):bool ; 
    public function isExist(int $id):bool;
    public function show (int $id):object ; 
    public function update (array $data , int $id) : bool ; 
}
