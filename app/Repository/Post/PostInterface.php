<?php

namespace App\Repository\Post;

use App\Models\Post;

interface PostInterface{
    public function getAll();
    public function create($data);
    public function read($id);
    public function update($id, $data);
    public function delete($id);
}
