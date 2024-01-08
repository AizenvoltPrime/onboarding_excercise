<x-layout>
    <nav class="bg-gray-800 p-4 text-slate-300 rounded-lg mt-2">
        <div class="container mx-auto flex items-center justify-between gap-4 text-lg font-semibold">
            <div>
                <a href="{{ route('dashboard') }}" class="hover:text-gray-300">Dashboard</a>
            </div>
            <div>
                <a href="{{ route('tasks.index') }}" class="hover:text-gray-300">Tasks</a>
            </div>
            <div>
                @auth
                    <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="hover:text-gray-300">Logout</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                        @csrf
                    </form>
                @endauth
            </div>
        </div>
    </nav>
    <div class="flex flex-col bg-slate-800 p-2 rounded-lg items-center justify-center mt-48 text-2xl">
        <h1 class="p-2 rounded-full mb-3"><span class="material-symbols-outlined" style="font-size:8rem; color:rgb(15 23 42);">add_task</span></h1>

        <form method="POST" action="{{ route('tasks.store') }}" class="flex flex-col justify-center">
            @csrf

            <table class="bg-slate-700 text-slate-300 rounded-lg">
                <tr>
                    <th class="p-1">
                        <label for="name">Task Name:</label>
                    </th>
                    <td class="p-1">
                        <input type="text" id="name" name="name" required class="rounded-lg bg-slate-300 text-slate-500 text-center">
                    </td>
                </tr>

                <tr>
                    <th class="p-1">
                        <label for="priority">Priority:</label>
                    </th>
                    <td class="p-1">
                        <select id="priority" name="priority" class="w-full h-full block text-center rounded-lg bg-slate-300 text-slate-500">
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
                        <select id="status" name="status" class="w-full h-full block text-center rounded-lg bg-slate-300 text-slate-500">
                            <option value="pending">Select Status</option>
                            <option value="pending">Pending</option>
                            <option value="complete">Complete</option>
                        </select>
                    </td>
                </tr>
            </table>
            <button type="submit" class="bg-zinc-800 p-2 rounded-lg text-1 self-center mt-2 border-2 border-slate-500">Add Task</button>
        </form>
    </div>
</x-layout>
