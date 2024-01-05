<x-layout>
    <div class="container">
        <h1>Dashboard</h1>
        @guest
            <p>Welcome to the dashboard. Please log in or register.</p>
            <a href="{{ route('login') }}" class="button">Login</a>
            <a href="{{ route('register') }}" class="button">Register</a>
        @else
            <p>Welcome, {{ auth()->user()->name }}!</p>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit">Logout</button>
            </form>
        @endguest
    </div>
</x-layout>
