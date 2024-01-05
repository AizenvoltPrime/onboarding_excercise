<x-layout>
    <div class="flex flex-col justify-center items-center bg-slate-800 rounded-xl p-3 text-2xl mt-28">
        <h1 class="p-2 rounded-full mb-3"><span class="material-symbols-outlined" style="font-size:8rem; color:rgb(15 23 42);">account_circle</span></h1>
        <form method="POST" action="{{ route('login') }}" class="flex flex-col text-slate-200 items-center justify-center gap-2 mt-1">
            @csrf
            <div class="flex flex-col justify-center items-center gap-1">
                <label for="email">Email</label>
                <input type="email" name="email" class="rounded-lg bg-slate-700 text-slate-300 text-center outline-slate-500" required>
            </div>
            <div class="flex flex-col justify-center items-center gap-1">
                <label for="password">Password</label>
                <input type="password" name="password" class="rounded-lg bg-slate-700 text-slate-300 text-center outline-slate-500" required>
            </div>
            <div>
                <button type="submit" class="mx-auto block bg-zinc-800 p-2 rounded-lg text-1 self-center border-2 border-slate-500">Login</button>
            </div>
        </form>
    </div>
</x-layout>
