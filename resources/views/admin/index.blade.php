<x-layout>
    <x-card title="Správa kina">

        <nav class="flex gap-4">
            <a href="/admin/movies"
               class="flex-1 text-center p-6 border-2 border-gray-700 rounded-xl hover:border-stone-500
               hover:bg-gray-800
               transition-all group">
                <span class="block text-3xl mb-2">🎬</span>
                <span class="text-xl font-bold text-gray-300">Filmy</span>
            </a>

            <a href="/admin/halls"
               class="flex-1 text-center p-6 border-2 border-gray-700 rounded-xl hover:border-stone-500
               transition-all group hover:bg-gray-800">
                <span class="block text-3xl mb-2">🏛️</span>
                <span class="text-xl font-bold text-gray-300">Sály</span>
            </a>
        </nav>

        {{-- Tady se pak může zobrazovat obsah konkrétní sekce --}}
        <div class="mt-10 text-gray-500 italic text-sm text-center">
            Vyberte sekci, kterou chcete spravovat.
        </div>
    </x-card>
</x-layout>
