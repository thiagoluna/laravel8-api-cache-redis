<?php

declare(strict_types=1);

namespace App\Observers;

use App\Models\Course;
use Illuminate\Support\Str;

class CourseObserver
{
    /**
     * Handle the Course "creating" event.
     *
     * @param  \App\Models\Course  $course
     * @return void
     */
    public function creating(Course $course) : void
    {
        $course->uuid = (string) Str::uuid();
    }
}
