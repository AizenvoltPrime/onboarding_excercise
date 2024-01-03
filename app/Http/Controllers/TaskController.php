<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Enums\TaskPriority;
use App\Enums\TaskStatus;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tasks = Task::all();
        return view('tasks.index', compact('tasks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('tasks.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'priority' => ['required', Rule::in(TaskPriority::cases())],
            'status' => ['required', Rule::in(TaskStatus::cases())],
            // other fields as necessary
        ]);

        $task = new Task();
        $task->name = $validatedData['name'];
        $task->priority = TaskPriority::from($validatedData['priority']);
        $task->status = TaskStatus::from($validatedData['status']);
        $task->completed = $request->status === 'complete' ? 1 : 0;
        $task->save();

        return redirect()->route('tasks.index');
    }

    public function toggleCompleted(Task $task)
    {
        $task->completed = !$task->completed;
        $task->save();

        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
