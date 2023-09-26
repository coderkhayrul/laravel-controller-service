<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use App\Services\TodoService;
use Illuminate\Http\Request;

class TodoController extends Controller
{

    private $todoService;

    public function __construct(TodoService $todoService)
    {
        $this->todoService = $todoService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $todos = $this->todoService->index();
        return view('welcome', compact('todos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $store = $this->todoService->create($request);

        if ($store) {
            return back()->with('success', 'Todo created successfully!');
        } else {
            return back()->with('error', 'Todo could not be created!');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Todo $todo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Todo $todo)
    {
        $todo = $this->todoService->edit($todo);
        return view ('edit', compact('todo'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Todo $todo)
    {
        $update = $this->todoService->update($request, $todo);

        if ($update) {
            return redirect()->route('todo.index')->with('success', 'Todo updated successfully!');
        } else {
            return back()->with('error', 'Todo could not be updated!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Todo $todo)
    {
        $this->todoService->delete($todo);
        return response()->json(['success' => 'Todo deleted successfully!']);
    }
}
