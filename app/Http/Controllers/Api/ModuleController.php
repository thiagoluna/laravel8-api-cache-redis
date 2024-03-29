<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ModuleRequest;
use App\Http\Resources\ModuleResource;
use App\Services\ModuleService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Symfony\Component\HttpFoundation\Response;

class ModuleController extends Controller
{
    private ModuleService $moduleService;

    public function __construct(ModuleService $moduleService)
    {
        $this->moduleService = $moduleService;
    }

    public function index() : ResourceCollection
    {
        $modules = $this->moduleService->getModules();

        return ModuleResource::collection($modules);
    }

    public function store(ModuleRequest $request)
    {
        $module = $this->moduleService->storeNewModule($request->validated());

        return new ModuleResource($module);
    }

    public function show(string $course) : ModuleResource
    {
        $modules = $this->moduleService->showModule($course);

        return new ModuleResource($modules);
    }

    public function update(ModuleRequest $request, string $module) : JsonResponse
    {
        $this->moduleService->updateModule($request->validated(), $module);

        return response()->json(['message' => 'updated']);
    }

    public function destroy(string $uuid) : JsonResponse
    {
        $this->moduleService->destroyModule($uuid);

        return response()->json([], Response::HTTP_NO_CONTENT);
    }
}
