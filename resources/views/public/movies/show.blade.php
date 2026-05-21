<x-layout>
    <x-ui.card title="Detail filmu">
        <div class="flex flex-col gap-8">

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="md:col-span-1">
                    @if($movie->image_path)
                        <img
                            src="{{ asset('storage/' . $movie->image_path) }}"
                            alt="{{ $movie->name }}"
                            class="w-full h-auto rounded-lg shadow-md border border-slate-700"
                        >
                    @else
                        <div class="w-full aspect-2/3 bg-slate-800 rounded-lg flex items-center justify-center
                        border border-slate-700 text-slate-500 text-sm">
                            Žádný plakát k dispozici
                        </div>
                    @endif
                </div>

                <div class="md:col-span-2">
                    <h1 class="text-3xl font-extrabold text-white mb-4">{{ $movie->name }}</h1>

                    @if($movie->description)
                        <p class="text-slate-300 leading-relaxed">
                            {{ $movie->description }}
                        </p>
                    @else
                        <p class="text-slate-500 italic">Tento film zatím nemá žádný popis.</p>
                    @endif
                </div>
            </div>

            <hr class="border-slate-800 my-2">

            <div class="bg-slate-900/50 border border-slate-800 rounded-xl p-6 w-full">
                <h3 class="text-xl font-bold text-amber-500 mb-4 flex items-center gap-2">
                    Nejbližší představení
                </h3>

                @if($movie->plays->isEmpty())
                    <p class="text-sm text-slate-500 italic p-2">Aktuálně nemáme naplánovaná žádná promítání tohoto filmu.</p>
                @else
                    <div class="grid grid-cols-1 gap-3 w-full">
                        @foreach($movie->plays as $play)
                            <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between p-4 bg-slate-800/40 border border-slate-800 rounded-lg hover:border-slate-700 transition gap-4 w-full">
                                <div>
                                    <span class="block text-lg text-white font-semibold">
                                        {{ \Carbon\Carbon::parse($play->start_date)->format('d. m. Y') }}
                                        {{ \Carbon\Carbon::parse($play->start_time)->format('H:i') }}
                                    </span>
                                    <span>

                                    </span>
                                    <span class="text-sm text-slate-400">
                                        Sál: <span class="text-slate-200 font-medium">{{ $play->hall->name }}</span>
                                        <span class="mx-2 text-slate-600">|</span>
                                        Základní: <span class="text-slate-200 font-medium">{{ $play->standard_price }} Kč</span>
                                        <span class="mx-2 text-slate-600">|</span>
                                        VIP: <span class="text-amber-500 font-medium">{{ $play->vip_price }} Kč</span>
                                    </span>
                                </div>

                                <div class="w-full sm:w-auto text-right">
                                    <x-ui.action-button :href="route('public.plays.show', $play)" class="w-full sm:w-auto text-center">
                                        Koupit lístky
                                    </x-ui.action-button>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </x-ui.card>
</x-layout>
