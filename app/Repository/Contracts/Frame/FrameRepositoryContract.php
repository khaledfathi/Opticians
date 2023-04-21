<?php 
namespace App\Repository\Contracts\Frame;
use App\Models\FrameModel; 

interface FrameRepositoryContract{
    public function store(array $data):FrameModel; 
    public function index():object; 
    public function isExist (int $id):bool; 
    public function show (int $id):object; 
    public function update(array $data , int $id):bool; 
}