<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\Course;
use App\Models\Module;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class ModuleRepository
{
    protected Module $entity;

    public function __construct(Module $module)
    {
        $this->entity = $module;
    }

    public function getAllModules(string $course) : Collection
    {
        return $this->entity->where('uuid', $course)->get();
    }

    public function getModule(string $module) : Module
    {
        return $this->entity->find($module);
    }

    public function getModules() : Collection
    {
        return $this->entity->get();
    }

    public function getModuleByUuid(string $uuid) : Module
    {
        return $this->entity->where('uuid', $uuid)->firstOrFail();
    }

    public function getModulesByCourseId(Course $course) : Collection
    {
        return $this->entity->where('course_id', $course)->get();
    }

    public function createNewModule(array $request, Course $course) : Model
    {
       return $course->modules()->create($request);
    }

    public function updateModuleByUuid(array $request, string $uuid) : bool
    {
        return $this->getModuleByUuid($uuid)->update($request);
    }

    public function destroyModuleByUuid(string $uuid) : bool
    {
        return $this->getModuleByUuid($uuid)->delete();
    }
}
