<?php

namespace App\Http\Controllers;

use App\Todo;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    public function store()
    {
        Todo::create($this->validateRequest());

        return redirect()->back();
    }

    public function delete(Todo $todo)
    {
        $todo->delete();

        return response()->redirectTo("/");
    }

    public function update(Todo $todo)
    {
        $todo->update($this->validateRequest());

        return response()->redirectTo("/todo/".$todo->id);
    }

    public function updateReadyMark(Todo $todo)
    {
        $todo->update(['ready' => ! (bool)$todo->ready]);

        return redirect()->back();
    }

    private function validateRequest()
    {
        return request()->validate([
            'name' => 'required',
            'section_id' => 'required',
        ]);
    }
}
