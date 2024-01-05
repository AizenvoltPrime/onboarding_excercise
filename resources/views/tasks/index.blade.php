<x-layout>
    @vite('resources/js/app.js')
    <div class="mt-32 flex flex-col justify-center items-center max-w-4xl gap-1">
        <h1 class="text-center bg-slate-800 p-2 rounded-full text-3xl mb-2">Todo List</h1>
        <div class="self-end border-2 p-1 border-slate-50 text-sm rounded-lg">
            <a href="{{ route('tasks.create') }}">Add Task</a>
        </div>
        <div class="flex justify-center">
            <table class="table-spacing min-w-full divide-y divide-gray-600 rounded-lg overflow-hidden text-center">
                <thead class="bg-gray-600 text-slate-200">
                    <tr>
                        <th class="px-6 py-3 text-xs font-medium uppercase tracking-wider">ID</th>
                        <th class="px-6 py-3 text-xs font-medium uppercase tracking-wider">Task Name</th>
                        <th class="px-6 py-3 text-xs font-medium uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-xs font-medium uppercase tracking-wider">Completed</th>
                        <th class="px-6 py-3 text-xs font-medium uppercase tracking-wider">Edit</th>
                        <th class="px-6 py-3 text-xs font-medium uppercase tracking-wider">Remove</th>
                    </tr>
                </thead>
                    <tbody class="bg-gray-300 divide-y divide-gray-200 text-slate-500">
                        @foreach ($tasks as $task)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $task->id }}</td>
                                @if ($task->status->value == 'complete')
                                    <td class="px-6 py-4 whitespace-nowrap line-through text-slate-400 text-left">{{ $task->name }}</td>
                                @else
                                    <td class="px-6 py-4 whitespace-nowrap text-left">{{ $task->name }}</td>
                                @endif
                                @if ($task->status->value == 'complete')
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-green-500 border-2 p-1 border-green-500 text-center rounded-lg">{{ ucfirst($task->status->value) }}</div>
                                    </td>
                                @elseif ($task->priority->value == 'low')
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-yellow-200 border-2 p-1 border-yellow-200 text-center rounded-lg">{{ ucfirst($task->status->value) }}</div>
                                    </td>
                                @elseif ($task->priority->value =='normal')
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-orange-500 border-2 p-1 border-orange-500 text-center rounded-lg">{{ ucfirst($task->status->value) }}</div>
                                    </td>
                                @elseif ($task->priority->value == 'high')
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-red-700 border-2 p-1 border-red-700 text-center rounded-lg">{{ ucfirst($task->status->value) }}</div>
                                    </td>
                                @endif
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <form method="POST" action="{{ route('tasks.toggle', $task->id) }}">
                                        @csrf
                                        @method('PATCH')
                                        <input type="checkbox" name="completed" onChange="this.form.submit()" {{ $task->completed ? 'checked' : '' }}>
                                    </form>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <a href="{{ route('tasks.edit', $task) }}"><span class="material-symbols-outlined">edit</span></a>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <form data-dir="delete-task" action="{{ route('tasks.destroy', $task) }}" method="POST" onsubmit="return confirmDelete(event)">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"><span class="material-symbols-outlined">delete</span></button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
            </table>
        </div>
    </div>
</x-layout>
