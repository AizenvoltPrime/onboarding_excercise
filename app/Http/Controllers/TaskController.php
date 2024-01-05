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
        // Check if the authenticated user is an admin
        if (auth()->user()->role === 'admin') {
            // If the user is an admin, retrieve all tasks
            $tasks = Task::all();
        } else {
            // If the user is not an admin, retrieve only their tasks
            $tasks = Task::where('user_id', auth()->id())->get();
        }

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
        ]);

        $task = new Task();
        $task->name = $validatedData['name'];
        $task->user_id = auth()->id();
        $task->priority = TaskPriority::from($validatedData['priority']);
        $task->status = TaskStatus::from($validatedData['status']);
        $task->completed = $request->status === 'complete' ? 1 : 0;
        $task->save();

        return redirect()->route('tasks.index');
    }

    public function toggleCompleted(Task $task)
    {
        $task->completed = !$task->completed;
        $task->status = $task->completed ? TaskStatus::Complete : TaskStatus::Pending;
        $task->save();

        return back();
    }

    public function destroy(Task $task)
    {
        // Check if the user is not an admin or not logged in, abort the action
        if (!auth()->check() || auth()->user()->role != 'admin') {
            abort(403);
        }

        $task->delete();

        return redirect()->route('tasks.index')->with('success', 'Task deleted successfully.');
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
        $task = Task::findOrFail($id);
        return view('tasks.edit', compact('task'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Task $task)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'priority' => ['required', Rule::in(TaskPriority::cases())],
            'status' => ['required', Rule::in(TaskStatus::cases())],
        ]);

        // Update the task with validated data
        $task->name = $validatedData['name'];
        $task->priority = TaskPriority::from($validatedData['priority']);
        $task->status = TaskStatus::from($validatedData['status']);
        $task->completed = $request->status === 'complete' ? 1 : 0;

        // Save the task
        $task->save();

        // Redirect to the tasks index page with a success message
        return redirect()->route('tasks.index')->with('success', 'Task updated successfully.');
    }
}
