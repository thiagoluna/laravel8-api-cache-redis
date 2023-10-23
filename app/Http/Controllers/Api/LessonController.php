<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LessonRequest;
use App\Http\Resources\LessonResource;
use App\Services\LessonService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Symfony\Component\HttpFoundation\Response;

class LessonController extends Controller
{
    protected $lessonService;

    public function __construct(LessonService $lessonService)
    {
        $this->lessonService = $lessonService;
    }

    public function index($module) : ResourceCollection
    {
        $lessons = $this->lessonService->getLessonsByModule($module);

        return LessonResource::collection($lessons);
    }

    public function store(LessonRequest $request) : LessonResource
    {
        $module = $this->lessonService->createNewLesson($request->all());

        return new LessonResource($module);
    }

    public function show($module, $identify) : LessonResource
    {
        $module = $this->lessonService->getLessonByModule($module, $identify);

        return new LessonResource($module);
    }

    public function update(LessonRequest $request, $module, $identify) : JsonResponse
    {
        $this->lessonService->updateLesson($identify, $request->all());

        return response()->json(['message' => 'updated']);
    }

    public function destroy($module, $identify) : JsonResponse
    {
        $this->lessonService->deleteLesson($identify);

        return response()->json([], Response::HTTP_NO_CONTENT);
    }
}
