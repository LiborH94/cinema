<x-layout>
    <div class="max-w-4xl mx-auto px-2 md:px-0">
        <x-ui.card title="Košík">
            @auth
                @if($cartItems->isNotEmpty())

                    <div class="space-y-3">
                        @foreach($cartItems as $item)
                            <div class="bg-slate-900 border border-slate-800 rounded-xl p-4 md:px-6 md:py-4 flex flex-col md:flex-row md:items-center justify-between gap-3 md:gap-6 relative">

                                <div class="grow min-w-0 pr-8 md:pr-0">
                                    <div class="font-bold text-white text-base md:text-lg leading-tight truncate">
                                        {{ $item->play->movie->name }}
                                    </div>
                                    <div class="text-xs text-slate-500 flex items-center gap-2 mt-1">
                                        <span class="font-medium text-slate-400">
                                            {{ \Carbon\Carbon::parse($item->play->start_date)->format('d.m.Y') }}
                                        </span>
                                        <span>•</span>
                                        <span>
                                            {{ \Carbon\Carbon::parse($item->play->start_time)->format('H:i') }}
                                        </span>
                                        <span>•</span>
                                        <span class="text-slate-600 font-medium hidden md:inline">
                                            {{ $item->play->hall->name }}
                                        </span>
                                    </div>
                                </div>

                                <div class="md:hidden text-xs text-slate-400 font-medium">
                                    Sál: <span class="text-slate-300">{{ $item->play->hall->name }}</span>
                                </div>

                                <div class="shrink-0">
                                    <span class="inline-block bg-slate-950 border border-slate-800 text-slate-300 px-2.5 py-1 rounded-md text-xs font-semibold">
                                        Řada {{ $item->seat->row }}, Sedadlo {{ $item->seat->column }}
                                        <span class="text-slate-500 ml-1 font-normal">({{ $item->seat->type }})</span>
                                    </span>
                                </div>

                                <div class="flex items-center justify-between md:justify-end gap-6 border-t md:border-t-0 border-slate-800/60 pt-3 md:pt-0 mt-1 md:mt-0 shrink-0">
                                    <div class="font-mono text-amber-500 font-black text-base md:text-lg md:w-24 md:text-right">
                                        {{ $item->seat->type === \App\SeatType::VIP ? $item->play->vip_price : $item->play->standard_price }} Kč
                                    </div>

                                    <div class="absolute top-4 right-4 md:relative md:top-auto md:right-auto">
                                        <form action="{{ route('cart.remove', $item->play) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <input type="hidden" name="seat_id" value="{{ $item->seat->id }}">
                                            <button type="submit" class="text-slate-500 hover:text-red-500 p-1 cursor-pointer transition-colors" title="Odebrat z košíku">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                </div>

                            </div>
                        @endforeach
                    </div>

                    <div class="mt-6 flex flex-col items-center md:items-end gap-4 border-t border-slate-800 pt-6">
                        <div class="text-lg md:text-xl flex flex-col sm:flex-row items-center gap-1 sm:gap-0">
                            <span class="text-slate-400">Celkem k úhradě:</span>
                            <span class="text-2xl md:text-3xl font-black text-amber-500 sm:ml-4">{{ number_format($totalPrice, 0) }} Kč</span>
                        </div>

                        <div class="flex flex-col-reverse sm:flex-row gap-2 w-full sm:w-auto">
                            <x-ui.action-button :href="route('home')" class="w-full sm:w-auto text-center justify-center py-2.5 sm:py-2 text-xs">
                                Pokračovat v nákupu
                            </x-ui.action-button>
                            <form action="{{ route('public.checkout') }}" method="POST" class="w-full sm:w-auto">
                                @csrf
                                <x-ui.action-button class="w-full text-center justify-center py-2.5 sm:py-2 text-xs bg-amber-500 text-black hover:bg-amber-400">
                                    Zaplatit a stáhnout vstupenky
                                </x-ui.action-button>
                            </form>
                        </div>
                    </div>

                @else
                    <div class="py-16 text-center text-slate-500 bg-slate-900/40 rounded-xl border border-dashed border-slate-800 px-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto text-slate-700 mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                        </svg>
                        <p class="text-base font-medium">Váš košík je momentálně prázdný.</p>
                        <a href="{{ route('home') }}" class="text-amber-500 hover:underline mt-3 inline-block font-semibold uppercase tracking-wider text-xs">
                            Vyberte si film
                        </a>
                    </div>
                @endif
            @endauth
        </x-ui.card>
    </div>
</x-layout>
