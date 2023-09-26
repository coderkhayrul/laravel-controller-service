<?php

namespace App\Services;

use App\Models\Todo;

class TodoService
{

    public function index()
    {
        return Todo::all();
    }

    public function create($request)
    {
        $todo = new Todo();
        $data = [
            'title' => $request->title,
            'description' => $request->description
        ];
        // create
        return $todo->create($data);
    }

    public function delete($todo)
    {
        return $todo->delete();
    }
}
