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
        $this->title = 'Classes';
    }

    public function index()
    {
        return view('pages.classes.list')
            ->with('title', $this->title);
    }

    public function create(Request $request)
    {
        $this->class->create($request);
        return redirect($_SERVER['HTTP_REFERER'])
            ->with('message', 'Class Created');
    }

    public function read($id)
    {
        $this->class->read($id);
        return view('pages.classes.edit')
            ->with('class', $this->class->read($id))
            ->with('title', $this->title);
    }

    public function update(Request $request, $id)
    {
        $this->class->update($id, $request);
        return redirect($_SERVER['HTTP_REFERER'])
            ->with('message', 'Class Updated');
    }

    public function delete($id)
    {
        $this->class->delete($id);
        return redirect($_SERVER['HTTP_REFERER'])
            ->with('message', 'Class Deleted');
    }
}
