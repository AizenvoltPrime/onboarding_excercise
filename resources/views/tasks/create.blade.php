<x-layout>
    <h1 class="text-center bg-zinc-800 p-2 rounded-full text-xl mb-3">Create New Task</h1>

    <form method="POST" action="{{ route('tasks.store') }}" class="flex flex-col justify-center">
        @csrf

        <table class="bg-gray-600 text-slate-200 rounded-lg">
            <tr>
                <th class="p-1">
                    <label for="name">Task Name:</label>
                </th>
                <td class="p-1">
                    <input type="text" id="name" name="name" required class="rounded-lg bg-gray-300 text-slate-500 text-center">
                </td>
            </tr>

            <tr>
                <th class="p-1">
                    <label for="priority">Priority:</label>
                </th>
                <td class="p-1">
                    <select id="priority" name="priority" class="w-full h-full block text-center rounded-lg bg-gray-300 text-slate-500">
                        <option value="normal">Select Priority</option>
                        <option value="low">Low</option>
                        <option value="normal">Normal</option>
                        <option value="high">High</option>
                    </select>
                </td>
            </tr>

            <tr>
                <th class="p-1">
                    <label for="status">Status:</label>
                </th>
                <td class="p-1">
                    <select id="status" name="status" class="w-full h-full block text-center rounded-lg bg-gray-300 text-slate-500">
                        <option value="pending">Select Status</option>
                        <option value="pending">Pending</option>
                        <option value="complete">Complete</option>
                    </select>
                </td>
            </tr>
        </table>
        <button type="submit" class="bg-zinc-800 p-2 rounded-full text-xl self-center mt-2">Add Task</button>
    </form>
</x-layout>
