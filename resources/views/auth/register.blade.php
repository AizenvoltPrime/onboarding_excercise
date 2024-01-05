<x-layout>
    <div class="flex flex-col justify-center items-center bg-slate-800 rounded-xl p-3 text-2xl mt-28">
    <h1 class="p-2 rounded-full mb-3"><span class="material-symbols-outlined" style="font-size:8rem; color:rgb(15 23 42);">account_circle</span></h1>
    <form method="POST" action="{{ route('register') }}" class="flex flex-col text-slate-200 items-center justify-center gap-2 mt-1">
        @csrf
        <div class="flex flex-col justify-center items-center gap-1">
            <label for="name">Name</label>
            <input class="rounded-lg bg-slate-700 text-slate-300 text-center outline-slate-500" type="text" name="name" id="name" required>
        </div>
        <div class="flex flex-col justify-center items-center gap-1">
            <label for="email">Email</label>
            <input class="rounded-lg bg-slate-700 text-slate-300 text-center outline-slate-500" type="email" name="email" id="email" required>
        </div>
        <div class="flex flex-col justify-center items-center gap-1">
            <label for="password">Password</label>
            <input class="rounded-lg bg-slate-700 text-slate-300 text-center outline-slate-500" type="password" name="password" id="password" required>
        </div>
        <div class="flex flex-col justify-center items-center gap-1">
            <label for="password_confirmation">Confirm Password</label>
            <input class="rounded-lg bg-slate-700 text-slate-300 text-center outline-slate-500" type="password" name="password_confirmation" id="password_confirmation" required>
        </div>
        <button type="submit" class="mx-auto block bg-zinc-800 p-2 rounded-lg text-1 self-center border-2 border-slate-500">Register</button>
    </form>
    </div>
</x-layout>
