<x-layout>
    <x-ui.card
        back-url="{{route('admin.index')}}"
        title="Správa filmové databáze"
    >
        <div class="flex justify-between items-center mb-8">
            <div class="flex flex-col">
                <h3 class="text-xl font-bold text-stone-200">Seznam filmů</h3>
                <p class="text-sm text-gray-500">Celkem nahraných filmů: {{ $movies->count() }}</p>
            </div>
            <x-ui.action-button :href="route('admin.movies.create')">
                + Přidat nový film
            </x-ui.action-button>
        </div>

        @if($movies->isEmpty())
            <div class="flex flex-col items-center justify-center p-12 border-2 border-dashed border-gray-800 rounded-2xl bg-gray-900/30">
                <h3 class="text-lg font-medium text-gray-400">Zatím jste nepřidali žádné filmy</h3>
                <p class="text-sm text-gray-600 mb-6">Vytvořte první záznam</p>
            </div>
        @else
            <div class="grid gap-4">
                @foreach($movies as $movie)
                    <div class="flex items-center justify-between p-4 bg-gray-800/40 border border-gray-700/50 rounded-xl hover:border-amber-500/50 transition-all group">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-16 shrink-0 bg-gray-700 rounded-md overflow-hidden shadow-inner">
                                @if($movie->image_path)
                                    <img src="{{ asset('storage/' . $movie->image_path) }}" alt="{{$movie->name}}"
                                         class="w-full h-full object-cover">
                                @else
                                    <div class="w-full flex flex-col items-center justify-center bg-slate-900 text-slate-700">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-12 h-12 mb-2 opacity-20">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 0 0 1.5-1.5V6a1.5 1.5 0 0 0-1.5-1.5H3.75A1.5 1.5 0 0 0 2.25 6v12a1.5 1.5 0 0 0 1.5 1.5Zm10.5-11.25h.008v.008h-.008V8.25Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                                        </svg>
                                        <span class="text-[10px] uppercase font-black tracking-widest opacity-30">Plakát chybí</span>
                                    </div>
                                @endif
                            </div>

                            <div>
                                <h3 class="font-bold text-stone-200 transition-colors">{{ $movie->name }}</h3>
                                <p class="text-xs text-gray-500 line-clamp-1 max-w-md">{{ $movie->description }}</p>
                            </div>
                        </div>

                        <div class="flex gap-2">
                            <x-ui.action-button :href="route('admin.movies.show', $movie)">
                                Upravit / Detail
                            </x-ui.action-button>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
        <x-ui.line class="my-8" />
    </x-ui.card>
</x-layout>
