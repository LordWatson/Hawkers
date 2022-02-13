<?php

namespace App\Http\Controllers;

use App\Repository\Role\RoleInterface;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    protected $role;

    public function __construct(RoleInterface $role)
    {
        $this->role = $role;
    }

    public function index()
    {
        //
    }

    public function create(Request $request)
    {
        $this->role->create($request);
        return redirect($_SERVER['HTTP_REFERER'])
            ->with('message', 'Role Created');
    }

    public function read($id)
    {
        $this->role->read($id);
        return view('role.edit')
            ->with('role', $this->role->read($id));
    }

    public function update(Request $request, $id)
    {
        $this->role->update($id, $request);
        return redirect($_SERVER['HTTP_REFERER'])
            ->with('message', 'Role Updated');
    }

    public function delete($id)
    {
        $this->role->delete($id);
        return redirect($_SERVER['HTTP_REFERER'])
            ->with('message', 'Role Deleted');
    }
}
