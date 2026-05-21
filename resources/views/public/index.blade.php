<x-layout>
    <x-ui.card class="max-w-6xl mx-auto px-2 md:px-4 py-4 md:py-8">

        <div class="mb-6 md:mb-8 text-center">
            <h1 class="text-2xl md:text-3xl font-black text-white uppercase tracking-wider">Aktuální program</h1>
            <p class="text-sm text-slate-400">Vyberte si film a rezervujte si svá místa</p>
        </div>

        <x-layout.calendar-nav :days="$days" route-name="home" />

        @if($plays->isEmpty())
            <div class="py-12 md:py-20 text-center bg-slate-900/50 rounded-2xl md:rounded-3xl border border-dashed border-slate-800 px-4">
                <p class="text-lg md:text-xl text-slate-500 font-medium">Na tento den nemáme naplánovaná žádná představení.</p>
                <a href="{{ route('home') }}" class="mt-4 inline-block text-amber-500 hover:underline">
                    Zobrazit dnešní program
                </a>
            </div>
        @else
            <div class="grid gap-4 md:gap-6">
                @foreach($plays as $play)
                    <div class="group relative bg-slate-900 border border-slate-800 rounded-lg overflow-hidden hover:border-amber-500/50 transition-all duration-500 shadow-xl">

                        <div class="flex flex-col md:flex-row items-stretch">

                            <div class="group relative bg-slate-900 ... flex flex-col md:flex-row">

                                <div class="w-full md:w-48 shrink-0 overflow-hidden">
                                    <img
                                        src="{{ asset('storage/' . $play->movie->image_path) }}"
                                        alt="{{ $play->movie->name }}"
                                        class="w-full h-auto md:h-full object-contain md:object-cover md:aspect-auto"
                                    >
                                </div>
                            </div>

                            <div class="p-4 md:p-8 grow flex flex-col justify-between">
                                <div>
                                    <div class="hidden md:flex flex-wrap items-center gap-3 mb-2">
                                        <span class="bg-amber-500 text-amber-950 px-3 py-1 rounded-full text-xs font-black uppercase tracking-widest">
                                            {{ \Carbon\Carbon::parse($play->start_time)->format('H:i') }}
                                        </span>
                                        <span class="text-slate-500 text-sm font-bold uppercase tracking-widest">
                                            {{ $play->hall->name }}
                                        </span>
                                    </div>

                                    <h2 class="text-xl md:text-3xl font-black text-white mb-1.5 md:mb-2 group-hover:text-amber-500 transition">
                                        {{ $play->movie->name }}
                                    </h2>

                                    <p class="text-slate-400 text-xs md:text-sm line-clamp-2 mb-4 md:mb-6 max-w-2xl">
                                        {{ $play->movie->description }}
                                    </p>
                                </div>

                                <div class="flex flex-col sm:flex-row gap-4 sm:items-center justify-between border-t border-slate-800/60 pt-4 md:pt-6">
                                    <div class="flex gap-6 justify-between sm:justify-start border-b sm:border-b-0 border-slate-800/40 pb-3 sm:pb-0">
                                        <div class="flex sm:flex-col items-center sm:items-start gap-2 sm:gap-0">
                                            <span class="block text-[10px] text-slate-500 uppercase font-bold tracking-wider">Standard</span>
                                            <span class="text-white font-bold text-sm md:text-base">{{ $play->standard_price }} Kč</span>
                                        </div>
                                        <div class="flex sm:flex-col items-center sm:items-start gap-2 sm:gap-0">
                                            <span class="block text-[10px] text-amber-500 uppercase font-bold tracking-wider">VIP</span>
                                            <span class="text-amber-500 font-bold text-sm md:text-base">{{ $play->vip_price }} Kč</span>
                                        </div>
                                    </div>

                                    <div class="grid grid-cols-2 gap-2 sm:flex sm:gap-3">
                                        <x-ui.action-button :href="route('public.movies.show', $play->movie)" class="w-full text-center text-xs justify-center py-2">
                                            Detaily
                                        </x-ui.action-button>
                                        <x-ui.action-button :href="route('public.plays.show', $play)" class="w-full text-center text-xs justify-center py-2">
                                            Vstupenky
                                        </x-ui.action-button>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </x-ui.card>
</x-layout>
