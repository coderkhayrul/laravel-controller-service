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
        //
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
        $info = [
            'title' => 'Todo New',
            'description' => 'Todo Description New',
        ];

        $store = $this->todoService->create($info);

        if ($store) {
            return "Todo created successfully!";
        } else {
            return "Something went wrong!";
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Todo $todo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Todo $todo)
    {
        //
    }
}
