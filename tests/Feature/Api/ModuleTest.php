<?php

declare(strict_types=1);

namespace Tests\Feature\Api;

use App\Models\Course;
use App\Models\Module;
use Tests\TestCase;

class ModuleTest extends TestCase
{
    public function test_get_all_modules() : void
    {
        $response = $this->getJson('/modules');
        $response->assertStatus(200);
    }

    public function test_get_count_modules() : void
    {
        Module::factory()->count(10)->create();
        $response = $this->getJson('/modules');
        $response->assertStatus(200);
        $response->assertJsonCount(10, 'data');
    }

    public function test_notfound_module() : void
    {
        $response = $this->getJson('/modules/171');

        $response->assertStatus(404);
    }

    public function test_validations_create_module() : void
    {
        $course = Course::factory()->create();

        $response = $this->postJson("/courses/{$course->uuid}/modules", []);

        $response->assertStatus(422);
    }

    public function test_create_module() : void
    {
        $course = Course::factory()->create();

        $response = $this->postJson("/courses/{$course->uuid}/modules", [
            'name' => 'Module 01',
            'course' => $course->uuid
        ]);

        $response->assertStatus(201);
    }

    public function test_validations_update_module() : void
    {
        $module = Module::factory()->create();
        $response = $this->putJson("/modules/{$module->uuid}", []);
        $response->assertStatus(422);
    }

    public function test_update_module() : void
    {
        $course = Course::factory()->create();
        $module = Module::factory()->create(['course_id' => $course->id]);
        $response = $this->putJson("/modules/{$module->uuid}", [
            'name' => 'PHP',
            'course' => $course->uuid
        ]);
        $response->assertStatus(200);
    }

    public function test_validations_delete_module() : void
    {
        $response = $this->deleteJson("/modules/171", []);
        $response->assertStatus(404);
    }

    public function test_delete_module() : void
    {
        $module = Module::factory()->create();
        $response = $this->deleteJson("/modules/{$module->uuid}");
        $response->assertStatus(204);
    }
}
