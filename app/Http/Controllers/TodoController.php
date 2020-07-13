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

    private function validateRequest()
    {
        return request()->validate([
            'name' => 'required',
            'section_id' => 'required'
        ]);
    }
}
