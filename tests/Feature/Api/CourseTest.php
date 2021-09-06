<?php

declare(strict_types=1);

namespace Tests\Feature\Api;

use App\Models\Course;
use Tests\TestCase;

class CourseTest extends TestCase
{
    public function test_get_all_courses() : void
    {
        $response = $this->getJson('/courses');
        $response->assertStatus(200);
    }

    public function test_get_count_courses() : void
    {
        Course::factory()->count(10)->create();
        $response = $this->getJson('/courses');
        $response->assertStatus(200);
        $response->assertJsonCount(10, 'data');
    }

    public function test_get_notfound_courses() : void
    {
        $response = $this->getJson('/courses/171');
        $response->assertStatus(404);
    }

    public function test_get_found_course() : void
    {
        $course = Course::factory()->create();
        $response = $this->getJson("/courses/{$course->uuid}");
        $response->assertStatus(200);
    }

    public function test_validations_create_course() : void
    {
        $response = $this->postJson("/courses", []);
        $response->assertStatus(422);
    }

    public function test_create_course() : void
    {
        $response = $this->postJson("/courses", [
            'name' => 'PHP'
        ]);
        $response->assertStatus(201);
    }

    public function test_validations_update_course() : void
    {
        $course = Course::factory()->create();
        $response = $this->putJson("/courses/{$course->uuid}", []);
        $response->assertStatus(422);
    }

    public function test_update_course() : void
    {
        $course = Course::factory()->create();
        $response = $this->putJson("/courses/{$course->uuid}", [
            'name' => 'PHP'
        ]);
        $response->assertStatus(200);
    }

    public function test_validations_delete_course() : void
    {
        $response = $this->deleteJson("/courses/171", []);
        $response->assertStatus(404);
    }

    public function test_delete_course() : void
    {
        $course = Course::factory()->create();
        $response = $this->deleteJson("/courses/{$course->uuid}");
        $response->assertStatus(204);
    }
}

