<x-layout>
    <h1>Todo List</h1>
        <a href="{{ route('tasks.create') }}">Add New Task</a>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Task Name</th>
                    <th>Priority</th>
                    <th>Completed</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($tasks as $task)
                    <tr>
                        <td>{{ $task->id }}</td>
                        <td>{{ $task->name }}</td>
                        <td>{{ ucfirst($task->priority->value) }}</td>
                        <td>{{ $task->completed ? 'Yes' : 'No' }}</td>
                        <td>
                            {{-- <a href="{{ route('tasks.edit', $task) }}">Edit</a> --}}
                            {{-- <a href="{{ route('tasks.show', $task) }}">View</a> --}}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
</x-layout>
