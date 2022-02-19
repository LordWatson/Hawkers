<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
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
        return $this->role->getAll();
    }

    public function store(Request $request)
    {
        return $this->role->create($request);
    }

    public function show($id)
    {
        return $this->role->read($id);
    }

    public function update(Request $request, $id)
    {
        return $this->role->update($id, $request);
    }

    public function destroy($id)
    {
        return $this->role->delete($id);
    }
}
