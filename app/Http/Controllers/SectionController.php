<?php

namespace App\Http\Controllers;

use App\Section;
use App\Todo;
use Illuminate\Http\Request;

class SectionController extends Controller
{
    public function store()
    {
        Section::create(request()->all());

        return response()->redirectTo("/");
    }

    public function delete(Section $section)
    {
        Todo::where('section_id', '=', $section->id)->delete();

        $section->delete();

        return response()->redirectTo("/");
    }
}
