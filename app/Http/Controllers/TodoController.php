<?php

namespace App\Http\Controllers;

use App\Todo;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    public function store()
    {
        Todo::create(request()->all());

        return response()->redirectTo("/");
    }

    public function delete(Todo $todo)
    {
        $todo->delete();

        return response()->redirectTo("/");
    }

    public function update(Todo $todo)
    {
        $todo->update(request()->all());

        return response()->redirectTo("/todo/".$todo->id);
    }
}
