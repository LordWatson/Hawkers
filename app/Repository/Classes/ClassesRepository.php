<?php

namespace App\Repository\Classes;
use App\Actions\CreateClassInstructor;
use App\Models\Classes;

class ClassesRepository implements ClassesInterface
{
    public function getAll()
    {
        return Classes::latest()->get();
    }

    public function create($data)
    {
        $class = new Classes();
        $class->name = $data['name'];
        $class->description = $data['description'];
        $class->start_date_time = $data['start_date_time'];
        $class->duration_hours = $data['duration_hours'];
        $class->duration_minutes = $data['duration_minutes'];
        $class->location = $data['location'];
        $class->spaces_available = $data['spaces_available'];

        return $class->save();
    }

    public function read($id)
    {
        return Classes::find($id);
    }

    public function update($id, $data)
    {
        $class = Classes::find($id);
        $class->name = $data['name'];
        $class->description = $data['description'];
        $class->start_date_time = $data['start_date_time'];
        $class->duration_hours = $data['duration_hours'];
        $class->duration_minutes = $data['duration_minutes'];
        $class->location = $data['location'];
        $class->spaces_available = $data['spaces_available'];

        return $class->save();
    }

    public function delete($id)
    {
        return Classes::find($id)->delete();
    }
}
