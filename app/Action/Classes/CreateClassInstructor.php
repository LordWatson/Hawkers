<?php

namespace App\Action\Classes;

use App\Models\ClassAttendee;
use App\Models\Classes;

class CreateClassInstructor
{
    /**
     * Create the action.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function execute($userId, $classId)
    {
        $classesAttendee = new ClassAttendee();
        $classesAttendee->user_id = $userId;
        $classesAttendee->classes_id = $classId;
        $classesAttendee->type = 'instructor';
        $classesAttendee->created_at = date("Y-m-d H:i:s");
        $classesAttendee->updated_at = date("Y-m-d H:i:s");

        return $classesAttendee->save();
    }
}
