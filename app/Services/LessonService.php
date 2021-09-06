<?php

declare(strict_types=1);

namespace App\Services;

use App\Repositories\LessonRepository;
use App\Repositories\ModuleRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class LessonService
{
    protected $lessonRepository;
    protected $moduleRepository;

    public function __construct(
        LessonRepository $lessonRepository,
        ModuleRepository $moduleRepository
    ) {
        $this->lessonRepository = $lessonRepository;
        $this->moduleRepository = $moduleRepository;
    }

    public function getLessonsByModule(string $uuid) : Collection
    {
        $module = $this->moduleRepository->getModuleByUuid($uuid);

        return $this->lessonRepository->getLessonsModule($module->id);
    }

    public function createNewLesson(array $data) : Model
    {
        $module = $this->moduleRepository->getModuleByUuid($data['module']);

        return $this->lessonRepository->createNewLesson($module->id, $data);
    }

    public function getLessonByModule(string $uuid, string $identify) : Model
    {
        $module = $this->moduleRepository->getModuleByUuid($uuid);

        return $this->lessonRepository->getLessonByModule($module->id, $identify);
    }

    public function updateLesson(string $identify, array $data) : bool
    {
        $module = $this->moduleRepository->getModuleByUuid($data['module']);

        return $this->lessonRepository->updateLessonByUuid($module->id, $identify, $data);
    }

    public function deleteLesson(string $identify) : bool
    {
        return $this->lessonRepository->deleteLessonByUuid($identify);
    }
}
