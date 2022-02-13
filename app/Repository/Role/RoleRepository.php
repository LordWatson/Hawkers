<?php

namespace App\Repository\Role;
use App\Models\Role;

class RoleRepository implements RoleInterface
{
    public function getAll()
    {
        return Role::latest()->get();
    }

    public function create($data)
    {
        $role = new Role();
        $role->name = $data['name'];
        return $role->save();
    }

    public function read($id)
    {
        return Role::find($id);
    }

    public function update($id, $data)
    {
        $role = Role::find($id);
        $role->name = $data['name'];
        return $role->save();
    }

    public function delete($id)
    {
        return Role::find($id)->delete();
    }
}
