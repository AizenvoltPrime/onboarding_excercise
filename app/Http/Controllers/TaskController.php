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
    public function index(Request $request)
    {
        // Define the number of items per page
        $perPage = 10;

        // Start the query builder
        $query = Task::query();

        // Check the total number of tasks
        $totalTasks = Task::count();

        if ($request->filled('priority')) {
            $query->where('priority', $request->priority);
        }

        if ($request->filled('status')) {
            $status = $request->status === 'complete' ? 1 : 0;
            $query->where('completed', $status);
        }

        if ($request->filled('title')) {
            $query->where('name', 'like', '%' . $request->title . '%');
        }

        if ($totalTasks > $perPage && auth()->user()->role === 'admin') {
            $tasks = $query->paginate($perPage);
        } else if ($totalTasks <= $perPage && auth()->user()->role === 'admin') {
            $tasks = $query->get();
        } else if ($totalTasks > $perPage && auth()->user()->role !== 'admin') {
            $tasks = $query->where('user_id', auth()->id())->paginate($perPage);
        } else if ($totalTasks <= $perPage && auth()->user()->role !== 'admin') {
            $tasks = $query->where('user_id', auth()->id())->get();
        }

        return view('tasks.index', [
            'tasks' =>
            $tasks->appends($request->except('page')), // Appends all current request parameters except 'page'
            'filters' => [
                'priority' => $request->priority,
                'status' => $request->status,
                'title' => $request->title,
            ],
        ]);
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
