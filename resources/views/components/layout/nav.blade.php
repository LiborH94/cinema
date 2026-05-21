<nav class="bg-slate-950 border-b border-slate-800 py-4 px-6 md:px-12 sticky top-0 z-50 flex flex-col md:flex-row
md:justify-between md:items-center text-slate-300 gap-4 md:gap-0 duration-300 transition-all">

    <div class="text-center md:text-left">
        <a href="{{ route('home') }}" class="group">
            <h2 class="text-2xl md:text-3xl font-black text-white tracking-tighter group-hover:text-amber-500 transition-colors">
                KINO
            </h2>
        </a>
    </div>

    <div class="flex flex-wrap justify-center items-center gap-4 sm:gap-6 md:gap-8 font-semibold text-sm uppercase
    tracking-widest">
        <a class="hover:text-amber-500 hover:scale-105 transition-all duration-500 ease-in-out"
           href="{{ route('home') }}">
            Program
        </a>
        <a class="hover:text-amber-500 hover:scale-105 transition-all duration-500 ease-in-out"
           href="{{ route('public.cart') }}">
            Košík
        </a>
        <a class="hover:text-amber-500 hover:scale-105 transition-all duration-500 ease-in-out" href="{{ route('public.tickets.index') }}">
            Vstupenky
        </a>

        <span class="w-full border-b border-slate-500 md:w-px md:h-6 md:border-r md:border-b-0 shrink-0 my-1
        md:my-0"></span>

        @can('isAdmin')
            <a class="md:ml-4 text-amber-500 hover:text-amber-500/80 hover:scale-105 transition-all duration-500
            ease-in-out" href="{{ route('admin.index') }}">
                Admin menu
            </a>
        @endcan
        @auth
            <a class="md:ml-4 text-gray-300 hover:text-amber-500/80 hover:scale-105 transition-all duration-500
            ease-in-out" href="{{ route('profile.show', auth()->user()) }}">
                {{ auth()->user()->name }}
            </a>
            <form action="{{ route('logout') }}" method="POST" class="inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="text-red-500 hover:text-red-600 hover:scale-105 transition-all
                duration-300 cursor-pointer uppercase tracking-widest font-semibold text-sm">
                    Odhlásit
                </button>
            </form>
        @endauth

        @guest
            <a class="md:ml-4 hover:text-amber-500 hover:scale-105 transition-all duration-500 ease-in-out" href="{{ route('login') }}">
                Login
            </a>
            <a class="bg-amber-500 text-black px-3 py-1.5 rounded-md hover:bg-amber-600 hover:scale-105 duration-300
            ease-in-out transition-all"
               href="{{route('register') }}">
                Registrace
            </a>
        @endguest
    </div>

</nav>
