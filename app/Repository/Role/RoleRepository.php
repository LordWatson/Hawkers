<?php

namespace App\Repository\Role;
use App\Models\Role;

class RoleRepository implements RoleInterface
{
    public function getAll()
    {
        return Role::all();
    }

    public function create($data)
    {
        $role = new Role();
        $role->name = $data['name'];
        $role->created_at = date("Y-m-d H:i:s");
        $role->updated_at = date("Y-m-d H:i:s");
        return $role->save();
    }

    public function read($id)
    {
        return Role::find($id);
    }

    public function search($query)
    {
        return Role::where('name', 'like', '%' . $query . '%')->get();
    }

    public function update($id, $data)
    {
        $role = Role::find($id);
        $role->name = $data['name'] ?? $role->name;
        $role->updated_at = date("Y-m-d H:i:s");
        return $role->update();
    }

    public function delete($id)
    {
        return Role::find($id)->delete();
    }
}
