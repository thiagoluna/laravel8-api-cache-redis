<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\Course;
use Illuminate\Database\Eloquent\Collection;

class CourseRepository
{
    protected Course $entity;

    public function __construct(Course $course)
    {
        $this->entity = $course;
    }

    public function getAllCourses() : Collection
    {
        return $this->entity->get();
    }

    public function getCourseByUuid(string $uuid) : Course
    {
        return $this->entity->where('uuid', $uuid)->firstOrFail();
    }

    public function createNewCourse(array $request) : Course
    {
        return $this->entity->create($request);
    }

    public function updateCourseByUuid(array $request, string $uuid) : bool
    {
        return $this->getCourseByUuid($uuid)->update($request);
    }

    public function destroyCourseByUuid(string $uuid) : bool
    {
        return $this->getCourseByUuid($uuid)->delete();
    }
}
