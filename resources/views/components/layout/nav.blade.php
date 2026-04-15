<nav class="flex justify-between items-center text-slate-300 bg-slate-800 backdrop-blur-md border-b border-slate-800
h-20 px-12 sticky top-0 z-50">
    <div>
        <a href="{{route('home')}}" class="group">
            <h2 class="text-3xl font-black text-white tracking-tighter group-hover:text-amber-500 transition-colors">
                KINO<span class="text-amber-500 group-hover:text-white">.</span>
            </h2>
        </a>
    </div>

    <div class="flex items-center">
        <div class="flex gap-8 font-semibold text-sm uppercase tracking-widest">
            <a class="hover:text-amber-500 transition-all duration-200 hover:scale-105" href="{{route('home')}}">Domů</a>
            <a class="hover:text-amber-500 transition-all duration-200 hover:scale-105" href="{{route('schedule')}}">Program</a>
            <a class="hover:text-amber-500 transition-all duration-200 hover:scale-105" href="">Košík</a>
        </div>

        <div class="w-[1px] h-6 bg-white mx-8"></div>

        <div class="flex gap-6 font-semibold text-sm uppercase tracking-widest">
            @can('admin')
                <a class="text-amber-500 hover:text-amber-400 transition-colors" href="/admin">Admin</a>
            @endcan

            @guest
                <a class="hover:text-white px-4 py-1.5 transition-colors" href="{{route('register')}}">Registrace</a>
                <a class="bg-amber-500 text-black px-4 py-1.5 rounded-lg hover:bg-amber-400 transition-all" href="{{route('login')}}">Login</a>
            @endguest

            @auth
                <form action="{{route('logout')}}" method="POST" class="inline">
                    @csrf
                    @method('DELETE')
                    <button class="hover:text-red-500 transition-colors cursor-pointer uppercase tracking-widest text-sm font-semibold" type="submit">
                        Odhlásit
                    </button>
                </form>
            @endauth
        </div>
    </div>
</nav>
