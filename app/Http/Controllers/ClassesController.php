<?php

namespace App\Http\Controllers;

use App\Models\Classes;
use App\Repository\Classes\ClassesInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClassesController extends Controller
{
    protected $class;
    private $title;

    public function __construct(ClassesInterface $class)
    {
        $this->class = $class;
    }

    public function index()
    {
        return $this->class->getAll();
    }

    public function store(Request $request)
    {
        return $this->class->create($request);
    }

    public function show($id)
    {
        return $this->class->read($id);
    }

    public function update(Request $request, $id)
    {
        return $this->class->update($id, $request);
    }

    public function destroy($id)
    {
        return $this->class->delete($id);
    }
}
