<x-layout>
    <h1 class="text-center bg-zinc-800 p-2 rounded-full text-xl mb-3">Edit Task</h1>

    <form method="POST" action="{{ route('tasks.update', $task->id) }}" class="flex flex-col justify-center">
        @csrf
        @method('PATCH')
        <table class="bg-gray-600 text-slate-200 rounded-lg">
            <tr>
                <th class="p-1">
                    <label for="name">Task Name:</label>
                </th>
                <td class="p-1">
                    <input type="text" id="name" name="name" value="{{ old('name', $task->name) }}" required class="rounded-lg bg-gray-300 text-slate-500 text-center">
                </td>
            </tr>
            <tr>
                <th class="p-1">
                    <label for="priority">Priority:</label>
                </th>
                <td class="p-1">
                    <select name="priority" class="w-full h-full block text-center rounded-lg bg-gray-300 text-slate-500">
                        <option value="low" {{ $task->priority->value === 'low' ? 'selected' : '' }}>Low</option>
                        <option value="normal" {{ $task->priority->value === 'normal' ? 'selected' : '' }}>Normal</option>
                        <option value="high" {{ $task->priority->value === 'high' ? 'selected' : '' }}>High</option>
                    </select>
                </td>
            </tr>

            <tr>
                <th class="p-1">
                    <label for="status">Status:</label>
                </th>
                <td class="p-1">
                    <select name="status" class="w-full h-full block text-center rounded-lg bg-gray-300 text-slate-500">
                        <option value="pending" {{$task->status->value == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="complete" {{ $task->status->value == 'complete' ? 'selected' : '' }}>Complete</option>
                    </select>
                </td>
            </tr>
        </table>
        <button type="submit" class="bg-zinc-800 p-2 rounded-full text-1 self-center mt-2 border-2 border-slate-500">Save Changes</button>
    </form>
</x-layout>
