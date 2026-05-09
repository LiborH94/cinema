<x-layout>
    <x-ui.card
        title="Program kina"
    >
        <div class="flex justify-center gap-2 mb-10 overflow-x-auto pb-4 no-scrollbar">
            @foreach(range(0, 14) as $day)
                @php $date = now()->addDays($day)->locale('cs'); @endphp
                <button class="flex flex-col items-center min-w-[70px] p-2 rounded-lg border border-slate-800 bg-slate-900/50 hover:border-amber-500 hover:bg-amber-500 transition-all">
                    <span class="text-[10px] uppercase text-slate-500 group-hover:text-amber-950 font-bold">{{ $date->translatedFormat('D') }}</span>
                    <span class="text-lg font-black text-slate-200 group-hover:text-amber-950">{{ $date->translatedFormat('j.') }}</span>
                    <span class="text-[10px] text-slate-500 group-hover:text-amber-900 font-bold">{{ $date->translatedFormat('M') }}</span>
                </button>
            @endforeach
        </div>

        <div class="space-y-6">
            @foreach($movies as $movie)
                <div class="group flex flex-col md:flex-row gap-6 p-4 rounded-xl border border-slate-500
                bg-slate-900/30 hover:bg-slate-900/50 hover:border-amber-500/50 transition-all duration-300">

                    <div class="w-full md:w-40 shrink-0">
                        <div class="relative overflow-hidden rounded-lg shadow-2xl border border-slate-700/50">
                            @if($movie->image_path)
                                <img src="{{ asset('storage/' . $movie->image_path) }}"
                                     alt="{{ $movie->name }}"
                                     class="w-full object-cover transition-transform duration-500">
                            @else
                                <div class="w-full flex flex-col items-center justify-center bg-slate-900">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-12 h-12 mb-2 opacity-20">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 0 0 1.5-1.5V6a1.5 1.5 0 0 0-1.5-1.5H3.75A1.5 1.5 0 0 0 2.25 6v12a1.5 1.5 0 0 0 1.5 1.5Zm10.5-11.25h.008v.008h-.008V8.25Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                                    </svg>
                                    <span class="text-[10px] uppercase font-black tracking-widest opacity-30">Plakát chybí</span>
                                </div>
                            @endif

                        </div>
                    </div>

                    <div class="grow flex flex-col justify-center">


                        <h3 class="text-2xl font-black transition-colors uppercase tracking-tight mb-2">
                            {{ $movie->name }}
                        </h3>

                        <p class="text-sm line-clamp-3 max-w-2xl">
                            {{ $movie->description }}
                        </p>
                    </div>

                    <div class="w-full md:w-60 shrink-0 flex flex-col justify-center gap-3 border-t md:border-t-0
                    md:border-l border-slate-800/50 pt-4 md:pt-0 md:pl-6">
                        <x-ui.action-button :href="route('home')">
                            Vstupenky
                        </x-ui.action-button>
                    </div>

                </div>
            @endforeach
        </div>

    </x-ui.card>
</x-layout>
