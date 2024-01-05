<x-layout>
    <div class="flex flex-col justify-center items-center text-2xl min-h-screen">
        @guest
            <p>Welcome to the dashboard. Please log in or register.</p>
            <div class="flex items-center gap-2 mt-2">
                <button class="bg-slate-800 rounded-lg p-2 border-2 border-slate-700"><a href="{{ route('login') }}" class="button">Login</a></button>
                <button class="bg-slate-800 rounded-lg p-2 border-2 border-slate-700"><a href="{{ route('register') }}" class="button">Register</a></button>
            </div>
        @else
            <p>Welcome, {{ auth()->user()->name }}!</p>
            <form method="POST" action="{{ route('logout') }}" class="mt-2">
                @csrf
                <button class="bg-slate-800 rounded-lg p-2 border-2 border-slate-700"><a href="{{ route('tasks.index') }}" class="button">Tasks</a></button>
                <button class="bg-slate-800 rounded-lg p-2 border-2 border-slate-700" type="submit">Logout</button>
            </form>
        @endguest
    </div>
</x-layout>
