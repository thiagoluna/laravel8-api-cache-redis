<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CourseRequest;
use App\Http\Resources\CourseResource;
use App\Services\CourseService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\ResourceCollection;

class CourseController extends Controller
{
    private CourseService $courseService;

    public function __construct(CourseService $courseService)
    {
        $this->courseService = $courseService;
    }

    public function index() : ResourceCollection
    {
        $courses = $this->courseService->getCourses();

        return CourseResource::collection($courses);
    }

    public function store(CourseRequest $request) : CourseResource
    {
        $course = $this->courseService->storeNewCourse((array)$request->validated());

        return new CourseResource($course);
    }

    public function show(string $uuid) : CourseResource
    {
        $course = $this->courseService->showCourse($uuid);

        return new CourseResource($course);
    }

    public function update(CourseRequest $request, string $course) : JsonResponse
    {
        $result = $this->courseService->updateCourse((array)$request->validated(), $course);

        return response()->json(['message' => 'updated']);
    }

    public function destroy(string $uuid) : JsonResponse
    {
        $course = $this->courseService->destroyCourse($uuid);

        return response()->json([], 204);
    }
}
