<?php

namespace App\Repository\Role;

use App\Models\Role;

interface RoleInterface{
    public function getAll();
    public function create($data);
    public function read($id);
    public function update($id, $data);
    public function delete($id);
}
