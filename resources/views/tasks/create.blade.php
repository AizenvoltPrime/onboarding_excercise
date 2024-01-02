<x-layout>
    <h1>Create New Task</h1>

    <form method="POST" action="{{ route('tasks.store') }}">
        @csrf

        <div>
            <label for="name">Task Name:</label>
            <input type="text" id="name" name="name" required>
        </div>
        <!-- Priority input field -->
        <div>
            <label for="priority">Priority:</label>
            <select id="priority" name="priority" required>
                <option value="">Select Priority</option>
                <option value="low">Low</option>
                <option value="normal">Normal</option>
                <option value="high">High</option>
            </select>
        </div>

        <div>
            <button type="submit">Add Task</button>
        </div>
    </form>
</x-layout>
