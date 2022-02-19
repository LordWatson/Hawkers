<?php

namespace App\Repository\Classes;
use App\Actions\CreateClassInstructor;
use App\Models\Classes;

class ClassesRepository implements ClassesInterface
{
    public function getAll()
    {
        return Classes::all();
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
        $class->created_at = date("Y-m-d H:i:s");
        $class->updated_at = date("Y-m-d H:i:s");

        return $class->save();
    }

    public function read($id)
    {
        return Classes::find($id);
    }

    public function search($query)
    {
        return Classes::where('name', 'like', '%' . $query . '%')
            ->orWhere(function($q) use ($query){
                $q->where('description', 'like', '%' . $query . '%');
            })->get();
    }

    public function update($id, $data)
    {
        $class = Classes::find($id);
        $class->name = $data['name'] ?? $class->name;
        $class->description = $data['description'] ?? $class->description;
        $class->start_date_time = $data['start_date_time'] ?? $class->start_date_time;
        $class->duration_hours = $data['duration_hours'] ?? $class->duration_hours;
        $class->duration_minutes = $data['duration_minutes'] ?? $class->duration_minutes;
        $class->location = $data['location'] ?? $class->location;
        $class->spaces_available = $data['spaces_available'] ?? $class->spaces_available;
        $class->updated_at = date("Y-m-d H:i:s");

        return $class->update();
    }

    public function delete($id)
    {
        return Classes::find($id)->delete();
    }
}
