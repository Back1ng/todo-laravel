<?php

namespace Tests\Feature;

use App\Todo;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TodoManagementTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function todo_can_be_created()
    {
        $response = $this->post('/todo', $this->data());

        $response->assertRedirect("/");
        $this->assertCount(1, Todo::all());
    }

    /** @test */
    public function todo_can_be_deleted()
    {
        $this->post('/todo', $this->data());
        $this->assertCount(1, Todo::all());

        $response = $this->delete('/todo/'.Todo::first()->id);

        $response->assertRedirect("/");
        $this->assertCount(0, Todo::all());
    }

    /** @test */
    public function todo_can_be_edited()
    {
        $this->post('/todo', $this->data());
        $this->assertCount(1, Todo::all());

        $todo = Todo::first();
        $response = $this->put("/todo/".$todo->id, array_merge($this->data(), ['name' => 'Good Name']));
        $todo = $todo->fresh();

        $response->assertRedirect("/todo/".$todo->id);
        $this->assertNotEquals($this->data()['name'], $todo->name);
        $this->assertEquals("Good Name", $todo->name);
    }

    private function data()
    {
        return [
            'name' => "Random Name"
        ];
    }
}
