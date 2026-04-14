<nav class="flex justify-between items-center bg-gray-900 h-20 p-8">
    <div>
        <a href="">
            <h2 class="text-3xl font-bold">Kino</h2>
        </a>
    </div>
    <div class="flex text-center justify-center">
        <div class="flex justify-center items-center gap-6 text-stone-300 font-bold underline-offset-5 pr-8">
            <a class="inline-block hover:underline duration-200 ease-in-out hover:scale-110 hover:text-gray-400"
               href="">Domů</a>
            <a class="inline-block hover:underline duration-200 ease-in-out hover:scale-110 hover:text-gray-400"
               href="">Program</a>
            <a class="inline-block hover:underline duration-200 ease-in-out hover:scale-110
            hover:text-gray-400"
               href="">Košík</a>
        </div>
        <div class="w-[1px] h-8 bg-gray-600 mx-2"></div>
        <div class="flex justify-center items-center gap-6 text-stone-300 font-bold underline-offset-5 pl-8">
            @guest
                <a class="inline-block hover:underline duration-150 ease-in-out hover:scale-110 hover:text-gray-400"
                   href="{{route('register')}}">Registrovat</a>
                <a class="inline-block hover:underline duration-150 ease-in-out hover:scale-110 hover:text-gray-400"
                   href="">Přihlásit</a>
            @endguest
            @auth
                <a class="inline-block hover:underline duration-150 ease-in-out hover:scale-110 hover:font-bold
                hover:text-gray-400"
                   href="">Odhlásit se</a>
            @endauth
        </div>

    </div>
</nav>
