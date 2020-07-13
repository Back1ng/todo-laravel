<?php

namespace App\Http\Controllers;

use App\Section;
use App\Todo;
use Illuminate\Http\Request;

class SectionController extends Controller
{
    public function index()
    {
        return view('index', [
            'sections' => Section::all()
        ]);
    }

    public function show(Section $section)
    {
        return view('section.show', [
            'section' => $section,
            'todos' => $section->todo
        ]);
    }

    public function store()
    {
        Section::create($this->requestValidate());

        return response()->redirectTo("/");
    }

    public function delete(Section $section)
    {
        Todo::where('section_id', '=', $section->id)->delete();

        $section->delete();

        return response()->redirectTo("/");
    }

    private function requestValidate()
    {
        return request()->validate([
            'name' => 'required'
        ]);
    }
}
