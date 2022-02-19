<?php

namespace App\Repository\Classes;

use App\Models\Classes;

interface ClassesInterface{
    public function getAll();
    public function create($data);
    public function read($id);
    public function search($query);
    public function update($id, $data);
    public function delete($id);
}
