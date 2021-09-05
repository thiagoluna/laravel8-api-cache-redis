<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Course;
use App\Repositories\CourseRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class CourseService
{
    protected CourseRepository $courseRepository;

    public function __construct(CourseRepository $courseRepository)
    {
        $this->courseRepository = $courseRepository;
    }

    public function showCourse(string $uuid) : Course
    {
        return $this->courseRepository->getCourseByUuid($uuid);
    }

    public function getCourses() : Collection
    {
        return $this->courseRepository->getAllCourses();
    }

    public function storeNewCourse(array $request) : Course
    {
        return $this->courseRepository->createNewCourse($request);
    }

    public function updateCourse(array $request, string $uuid) : bool
    {
        return $this->courseRepository->updateCourseByUuid($request, $uuid);
    }

    public function destroyCourse(string $uuid) : bool
    {
        return $this->courseRepository->destroyCourseByUuid($uuid);
    }
}
