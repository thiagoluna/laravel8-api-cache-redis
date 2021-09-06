<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\Course;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class CourseRepository
{
    protected Course $entity;

    public function __construct(Course $course)
    {
        $this->entity = $course;
    }

    public function getAllCourses() : Collection
    {
//        return Cache::remember('courses', 120, function () {
//            return $this->entity->with('modules.lessons')->get();
//        });

        return Cache::rememberForever('courses', function () {
            return $this->entity->with('modules.lessons')->get();
        });
    }

    public function getCourseByUuid(string $uuid, bool $loadRelationships = true) : Model
    {
        $query = $this->entity->where('uuid', $uuid);

        if ($loadRelationships) {
            $query->with('modules.lessons');
        }

        return $query->firstOrFail();
    }

    public function createNewCourse(array $request) : Course
    {
        return $this->entity->create($request);
    }

    public function updateCourseByUuid(array $request, string $uuid) : bool
    {
        $course = $this->getCourseByUuid($uuid, false);

        Cache::forget('courses');

        return $course->update($request);
    }

    public function destroyCourseByUuid(string $uuid) : bool
    {
        $course = $this->getCourseByUuid($uuid, false);

        Cache::forget('courses');

        return $course->delete();
    }
}
