<x-layout>
    <x-ui.card class="max-w-6xl mx-auto px-4 py-8">
        <div class="mb-8 text-center">
            <h1 class="text-3xl font-black text-white uppercase tracking-wider">Aktuální program</h1>
            <p class="text-slate-400">Vyberte si film a rezervujte si svá místa</p>
        </div>

        <x-layout.calendar-nav :days="$days" route-name="home" />

        @if($plays->isEmpty())
            <div class="py-20 text-center bg-slate-900/50 rounded-3xl border border-dashed border-slate-800">
                <p class="text-xl text-slate-500 font-medium">Na tento den nemáme naplánovaná žádná představení.</p>
                <a href="{{ route('home') }}" class="mt-4 inline-block text-amber-500 hover:underline">Zobrazit dnešní
                    program</a>
            </div>
        @else
            <div class="grid gap-6">
                @foreach($plays as $play)
                    <div class="group relative bg-slate-900 border border-slate-800 rounded-lg overflow-hidden
                    hover:border-amber-500/50 transition-all duration-500 shadow-xl">
                        <div class="flex flex-col md:flex-row items-center">

                            <div class="w-full md:w-48 h-72 md:h-64 shrink-0 overflow-hidden">
                                <img
                                    src="{{ asset('storage/' . $play->movie->image_path) }}"
                                    alt="{{ $play->movie->name }}"
                                    class="w-full h-full object-cover"
                                >
                            </div>

                            <div class="p-8 grow">
                                <div class="flex flex-wrap items-center gap-3 mb-2">
                                    <span class="bg-amber-500 text-amber-950 px-3 py-1 rounded-full text-xs font-black uppercase tracking-widest">
                                        {{ \Carbon\Carbon::parse($play->start_time)->format('H:i') }}
                                    </span>
                                    <span class="text-slate-500 text-sm font-bold uppercase tracking-widest">
                                        {{ $play->hall->name }}
                                    </span>
                                </div>

                                <h2 class="text-2xl md:text-3xl font-black text-white mb-2 group-hover:text-amber-500 transition">
                                    {{ $play->movie->name }}
                                </h2>

                                <p class="text-slate-400 text-sm line-clamp-2 mb-6 max-w-2xl">
                                    {{$play->movie->description}}
                                </p>

                                <div class="flex items-center justify-between border-t border-slate-800 pt-6">
                                    <div class="flex gap-4">
                                        <div class="text-center">
                                            <span class="block text-[10px] text-slate-500 uppercase font-bold">Standard</span>
                                            <span class="text-white font-bold">{{ $play->standard_price }} Kč</span>
                                        </div>
                                        <div class="text-center">
                                            <span class="block text-[10px] text-amber-500 uppercase font-bold">VIP</span>
                                            <span class="text-amber-500 font-bold">{{ $play->vip_price }} Kč</span>
                                        </div>
                                    </div>
                                    <div class="flex gap-4">
                                        <x-ui.action-button
                                            :href="route('public.plays.showPlayDetails', $play)"
                                        >
                                            Detaily
                                        </x-ui.action-button>
                                        <x-ui.action-button
                                            :href="route('public.plays.showPlayToOrderTickets', $play)"
                                        >
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
