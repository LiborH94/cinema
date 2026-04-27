<x-layout>
    <div class="flex items-center justify-center">
        <x-ui.card title="Chyba 404">
            <div class="flex flex-col items-center text-center">
                <div class="mb-6 text-amber-500">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-20">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 3.75h.008v.008H12v-.008Z" />
                    </svg>
                </div>

                <h2 class="text-3xl font-bold text-gray-100 mb-4 tracking-tight">
                    Tato stránka neexistuje
                </h2>

                <p class="text-gray-500 mb-8 max-w-md">
                    Stránka, kterou hledáte, neexistuje nebo byla přesunuta.
                </p>

                <a href="{{ route('home') }}"
                   class="px-8 py-3 bg-amber-500 hover:bg-amber-600 text-slate-950 font-bold rounded-xl transition-all shadow-lg shadow-amber-500/20">
                    ZPĚT NA ÚVODNÍ STRÁNKU
                </a>
            </div>
        </x-ui.card>
    </div>
</x-layout>
