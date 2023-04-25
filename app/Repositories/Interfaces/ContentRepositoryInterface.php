<?php
namespace App\Repositories\Interfaces;

Interface ContentRepositoryInterface{

    public function all();
    public function store($data);
    public function find($id);
    public function update($data, $id);
    public function destroy($id);
}
