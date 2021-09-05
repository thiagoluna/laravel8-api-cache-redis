<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Module;
use App\Repositories\CourseRepository;
use App\Repositories\ModuleRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class ModuleService
{
    protected ModuleRepository $moduleRepository;
    protected CourseRepository $courseRepository;

    public function __construct(ModuleRepository $moduleRepository, CourseRepository $courseRepository)
    {
        $this->moduleRepository = $moduleRepository;
        $this->courseRepository = $courseRepository;
    }

    public function showModule(string $uuid) : Module
    {
        return $this->moduleRepository->getModuleByUuid($uuid);
    }

    public function getModule(string $module) : Module
    {
        return $this->moduleRepository->getModule($module);
    }

    public function getModules() : Collection
    {
        return $this->moduleRepository->getModules();
    }

    public function storeNewModule(array $request) : Model
    {
        $course = $this->courseRepository->getCourseByUuid($request['course']);

        return $this->moduleRepository->createNewModule($request, $course);
    }

    public function updateModule(array $request, string $uuid) : bool
    {
        return $this->moduleRepository->updateModuleByUuid($request, $uuid);
    }

    public function destroyModule(string $uuid) : bool
    {
        return $this->moduleRepository->destroyModuleByUuid($uuid);
    }
}
