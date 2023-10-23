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
        return $this->entity->orderBy('id', "desc")->get();

        //Eager Loading
        //return $this->entity->with('modules.lessons')->orderBy('id', "desc")->get();
    }

    public function getCachedAllCourses() : Collection
    {
        return Cache::remember('courses', config('course.modules.ttl_cache_in_seconds'), function () {
            return $this->entity->with('modules.lessons')->orderBy('id', "desc")->get();
        });
    }

    public function getOnlyCourses() : Collection
    {
        return Cache::remember('courses', config('course.modules.ttl_cache_in_seconds'), function () {
            return $this->entity->get();
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
