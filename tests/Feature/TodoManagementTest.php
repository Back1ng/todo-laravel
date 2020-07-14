<?php

namespace Tests\Feature;

use App\Section;
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
        $this->withoutExceptionHandling();
        $response = $this->post('/todo', $this->data());

        $response->assertRedirect("/");
        $response->assertSessionDoesntHaveErrors(['name']);
        $this->assertCount(1, Todo::all());
    }

    /** @test */
    public function todo_can_be_deleted()
    {
        $this->post('/todo', $this->data());
        $this->assertCount(1, Todo::all());

        $response = $this->delete('/todo/'.Todo::first()->id);

        $this->assertCount(0, Todo::all());
    }

    /** @test */
    public function todo_name_can_be_edited()
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

    /** @test */
    public function todo_name_is_required()
    {
        $response = $this->post('/todo', array_merge($this->data(), ['name' => '']));

        $response->assertSessionHasErrors(['name']);
    }

    /** @test */
    public function todo_ready_mark_is_set_at_creation()
    {
        $response = $this->post('/todo', $this->data());

        $this->assertCount(1, Todo::all());
        $this->assertEquals(0, Todo::first()->ready);
    }

    /** @test */
    public function todo_change_status_of_ready_mark()
    {
        $this->withoutExceptionHandling();
        $this->post('/todo', $this->data());
        $this->assertCount(1, Todo::all());

        $todo = Todo::first();
        $this->put('/todo/'.$todo->id.'/ready');
        $this->assertEquals(1, $todo->fresh()->ready);

        $this->put('/todo/'.$todo->id.'/ready');
        $this->assertEquals(0, $todo->fresh()->ready);
    }

    private function data()
    {
        return [
            'name' => "Random Name",
            'section_id' => factory(Section::class)->create()->id,
        ];
    }
}
