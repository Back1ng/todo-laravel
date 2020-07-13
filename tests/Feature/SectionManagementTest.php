<?php

namespace Tests\Feature;

use App\Section;
use App\Todo;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SectionManagementTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function section_can_be_created()
    {
        $response = $this->post('/section', $this->dataSection());

        $response->assertRedirect("/");
        $this->assertCount(1, Section::all());
    }

    /** @test */
    public function section_can_be_removed()
    {
        $this->withoutExceptionHandling();

        $response = $this->post('/section', $this->dataSection());
        $this->assertCount(1, Section::all());
        $this->post('/todo', ['name' => 'name', 'section_id' => Section::first()->id]);
        $sectionId = Section::all()->last()->id;

        $response = $this->delete('/section/'.$sectionId);

        $response->assertRedirect("/");
        $this->assertCount(0, Section::all());
        $this->assertCount(0, Todo::all()->where('section_id', '=', $sectionId));
    }

    /** @test */
    public function section_name_is_required()
    {
        $response = $this->post('/section', array_merge($this->dataSection(), ['name' => '']));

        $response->assertSessionHasErrors('name');
    }

    /** @test */
    public function section_dont_remove_another_todo()
    {
        $response = $this->post('/section', $this->dataSection());
        $response = $this->post('/section', $this->dataSection());
        $this->assertCount(2, Section::all());

        $this->post('/todo', $this->dataTodo(Section::first()->id));
        $this->post('/todo', $this->dataTodo(Section::first()->id));
        $this->post('/todo', $this->dataTodo(Section::all()->last()->id));

        $sectionId = Section::all()->last()->id;

        $response = $this->delete('/section/'.$sectionId);

        $this->assertCount(1, Section::all());
        $this->assertCount(0, Todo::all()->where('section_id', '=', $sectionId));
        $this->assertCount(2, Todo::all());
    }

    private function dataSection()
    {
        return [
            'name' => 'Good Name',
        ];
    }

    private function dataTodo($sectionId)
    {
        return [
            'name' => 'name',
            'section_id' => $sectionId
        ];
    }
}
