<x-layout>
    <nav class="bg-gray-800 p-4 text-slate-300 rounded-lg mt-2">
        <div class="container mx-auto flex items-center justify-between gap-4 text-lg font-semibold">
            <div>
                <a href="{{ route('dashboard') }}" class="hover:text-gray-300">Dashboard</a>
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
    @vite('resources/js/app.js')
    <div class="mt-32 flex flex-col justify-center items-center max-w-4xl gap-1">
        <h1 class="text-center bg-slate-800 p-2 rounded-full text-3xl mb-6">Todo List</h1>
        <!-- Filter Panel -->
        <div>
            <form action="{{ route('tasks.index') }}" method="GET" class="flex gap-2">
                <!-- Priority Filter -->
                <select name="priority" class="rounded-lg bg-slate-300 text-slate-500">
                    <option value="">All Priorities</option>
                    <option value="low" {{ $filters['priority'] == 'low' ? 'selected' : '' }}>Low</option>
                    <option value="normal" {{ $filters['priority'] == 'normal' ? 'selected' : '' }}>Normal</option>
                    <option value="high" {{ $filters['priority'] == 'high' ? 'selected' : '' }}>High</option>
                </select>
                <select name="status" class="rounded-lg bg-slate-300 text-slate-500">
                    <option value="">All Statuses</option>
                    <option value="pending" {{ $filters['status'] == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="complete" {{ $filters['status'] == 'complete' ? 'selected' : '' }}>Complete</option>
                </select>

                <input type="text" name="title" placeholder="Search by title" class="rounded-lg bg-slate-300 text-slate-500" value="{{ $filters['title'] }}" />

                <!-- Submit Button -->
                <button type="submit" class="bg-cyan-600 text-white rounded-md px-4">Filter</button>
            </form>
        </div>
        <div class="self-end border-2 p-1 border-slate-50 text-sm rounded-lg">
            <a href="{{ route('tasks.create') }}">Add Task</a>
        </div>
        <div class="flex justify-center">
            <table class="table-spacing min-w-full divide-y divide-gray-600 rounded-lg overflow-hidden text-center">
                <thead class="bg-gray-600 text-slate-200">
                    <tr>
                        <th class="px-6 py-3 text-xs font-medium uppercase tracking-wider">
                            <a href="{{ route('tasks.index', array_merge($filters, ['sort' => 'id', 'direction' => $sortDirection == 'asc' ? 'desc' : 'asc'])) }}">
                                ID
                                @if($sortField == 'id')
                                    @if($sortDirection == 'asc')
                                        &#9650; <!-- Upward arrow for ascending sort -->
                                    @else
                                        &#9660; <!-- Downward arrow for descending sort -->
                                    @endif
                                @endif
                            </a>
                        </th>
                        <th class="px-6 py-3 text-xs font-medium uppercase tracking-wider">
                            <a href="{{ route('tasks.index', array_merge($filters, ['sort' => 'name', 'direction' => $sortDirection == 'asc' ? 'desc' : 'asc'])) }}">
                                Task Name
                                @if($sortField == 'name')
                                    @if($sortDirection == 'asc')
                                        &#9650; <!-- Upward arrow for ascending sort -->
                                    @else
                                        &#9660; <!-- Downward arrow for descending sort -->
                                    @endif
                                @endif
                            </a>
                        </th>
                        <th class="px-6 py-3 text-xs font-medium uppercase tracking-wider">
                            <a href="{{ route('tasks.index', array_merge($filters, ['sort' => 'status', 'direction' => $sortField === 'status' && $sortDirection === 'asc' ? 'desc' : 'asc'])) }}">
                                Status
                                @if($sortField == 'status')
                                    @if($sortDirection == 'asc')
                                        &#9650; <!-- Upward arrow for ascending sort -->
                                    @else
                                        &#9660; <!-- Downward arrow for descending sort -->
                                    @endif
                                @endif
                            </a>
                        </th>
                        <th class="px-6 py-3 text-xs font-medium uppercase tracking-wider">
                            <a href="{{ route('tasks.index', array_merge($filters, ['sort' => 'completed', 'direction' => $sortField === 'completed' && $sortDirection === 'asc' ? 'desc' : 'asc'])) }}">
                                Completed
                                @if($sortField == 'completed')
                                    @if($sortDirection == 'asc')
                                        &#9650; <!-- Upward arrow for ascending sort -->
                                    @else
                                        &#9660; <!-- Downward arrow for descending sort -->
                                    @endif
                                @endif
                            </a>
                        </th>
                        <th class="px-6 py-3 text-xs font-medium uppercase tracking-wider">Edit</th>
                        @if(auth()->check() && auth()->user()->role == 'admin')
                            <th class="px-6 py-3 text-xs font-medium uppercase tracking-wider">Remove</th>
                        @endif
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
                                @if(auth()->check() && auth()->user()->role == 'admin')
                                    <td class="px-6 py-4 whitespace-nowrap">
                                            <form data-dir="delete-task" action="{{ route('tasks.destroy', $task) }}" method="POST" onsubmit="return confirmDelete(event)">
                                                @csrf
                                                @method('DELETE')
                                                <!-- Include current filter parameters as hidden fields -->
                                                @if(isset($filters['priority']))
                                                    <input type="hidden" name="priority" value="{{ $filters['priority'] }}">
                                                @endif
                                                @if(isset($filters['status']))
                                                    <input type="hidden" name="status" value="{{ $filters['status'] }}">
                                                @endif
                                                @if(isset($filters['title']))
                                                    <input type="hidden" name="title" value="{{ $filters['title'] }}">
                                                @endif
                                                @if(isset($filters['sort']))
                                                    <input type="hidden" name="sort" value="{{ $filters['sort'] }}">
                                                @endif
                                                @if(isset($filters['direction']))
                                                    <input type="hidden" name="direction" value="{{ $filters['direction'] }}">
                                                @endif
                                                <!-- Include the current page -->
                                                @if($tasks->count() == 1 && $tasks->currentPage() > 1)
                                                    <input type="hidden" name="page" value="{{ $tasks->currentPage() - 1 }}">
                                                @else
                                                    <input type="hidden" name="page" value="{{ $tasks->currentPage() }}">
                                                @endif
                                                <button type="submit"><span class="material-symbols-outlined">delete</span></button>
                                            </form>
                                        </td>
                                @endif
                            </tr>
                        @endforeach
                    </tbody>
            </table>
        </div>
        @if ($tasks->total() > 10)
            <div class="mt-2 mb-2">
                {{ $tasks->appends(array_merge($filters, ['sort' => $sortField, 'direction' => $sortDirection]))->links() }}
            </div>
        @endif
</x-layout>
