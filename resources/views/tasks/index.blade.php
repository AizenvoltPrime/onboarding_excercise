<x-layout>
    <h1 class="text-center bg-zinc-800 p-2 rounded-full text-xl mb-2">Todo List</h1>
    <div class="self-end border-2 p-1 border-slate-50 text-sm rounded-lg">
        <a href="{{ route('tasks.create') }}">Add Task</a>
    </div>
    <div class="flex justify-center">
        <table class="table-spacing min-w-full divide-y divide-gray-600 rounded-lg overflow-hidden">
            <thead class="bg-gray-600 text-slate-200">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">ID</th>
                    <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Task Name</th>
                    <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Priority</th>
                    <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Completed</th>
                    <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
                <tbody class="bg-gray-300 divide-y divide-gray-200 text-slate-500">
                    @foreach ($tasks as $task)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $task->id }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $task->name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ ucfirst($task->priority->value) }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $task->completed ? 'Yes' : 'No' }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                {{-- <a href="{{ route('tasks.edit', $task) }}">Edit</a> --}}
                                {{-- <a href="{{ route('tasks.show', $task) }}">View</a> --}}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
        </table>
    </div>
</x-layout>
