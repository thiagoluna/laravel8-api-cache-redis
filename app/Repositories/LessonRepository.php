<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\Lesson;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class LessonRepository
{
    protected $entity;

    public function __construct(Lesson $lesson)
    {
        $this->entity = $lesson;
    }

    public function getLessonsModule(int $moduleId) : Collection
    {
        return $this->entity
            ->where('module_id', $moduleId)
            ->get();
    }

    public function createNewLesson(int $moduleId, array $data) : Model
    {
        $data['module_id'] = $moduleId;

        return $this->entity->create($data);
    }

    public function getLessonByModule(int $moduleId, string $identify) : Model
    {
        return $this->entity
            ->where('module_id', $moduleId)
            ->where('uuid', $identify)
            ->firstOrfail();
    }

    public function getLessonByUuid(string $identify) : Model
    {
        return $this->entity
            ->where('uuid', $identify)
            ->firstOrfail();
    }

    public function updateLessonByUuid(int $moduleId, string $identify, array $data) : bool
    {
        $lesson = $this->getLessonByUuid($identify);

        $data['module_id'] = $moduleId;

        Cache::forget('courses');

        return $lesson->update($data);
    }

    public function deleteLessonByUuid(string $identify) : bool
    {
        $lesson = $this->getLessonByUuid($identify);

        Cache::forget('courses');

        return $lesson->delete();
    }
}
