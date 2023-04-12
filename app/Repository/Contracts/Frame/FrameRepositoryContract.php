<?php 
namespace App\Repository\Contracts\Frame;
use App\Models\FrameModel; 

interface FrameRepositoryContract{
    public function store(array $data):FrameModel; 
    public function index():object; 
    public function show (int $id):object; 
}