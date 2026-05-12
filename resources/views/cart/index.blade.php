<x-layout>
    <div class="max-w-4xl mx-auto">
        <x-ui.card title="Košík">
            @auth
                <div class="overflow-x-auto custom-scrollbar">
                    <table class="w-full text-left border-collapse bg-slate-900 rounded-xl">
                        <thead>
                        <tr class="border-b border-slate-800 text-slate-400 uppercase text-xs tracking-widest">
                            <th class="px-6 py-4 font-semibold">Představení</th>
                            <th class="px-6 py-4 font-semibold">Sedadlo</th>
                            <th class="px-6 py-4 font-semibold text-right">Cena</th>
                            <th class="px-6 py-4 font-semibold text-center">Akce</th>
                        </tr>
                        </thead>
                        <tbody class="text-slate-300">
                        @forelse($cartItems as $item)
                            <tr class="border-b border-slate-900 hover:bg-slate-900/50 transition-colors">
                                <td class="px-6 py-4">
                                    <div class="font-bold text-white">{{ $item->play->movie->name }}</div>
                                    <div class="text-sm text-slate-500 flex flex-col">
                                        <span>
                                            {{ \Carbon\Carbon::parse($item->play->start_date)->format('d.m.Y')}}
                                        </span>
                                        <span>
                                            {{ \Carbon\Carbon::parse($item->play->start_time)->format('H:i') }}
                                        </span>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                            <span class="bg-slate-800 px-2 py-1 rounded text-xs">
                                Řada {{ $item->seat->row }}, Sedadlo {{ $item->seat->column }}
                                ({{ $item->seat->type }})
                            </span>
                                </td>
                                <td class="px-6 py-4 text-right font-mono text-amber-500">
                                    {{ number_format($item->seat->type === \App\SeatType::VIP ? $item->play->vip_price :
                                    $item->play->standard_price, 0) }} Kč
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <form action="{{ route('cart.remove', $item->play) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <input type="hidden" name="seat_id" value="{{ $item->seat->id }}">
                                        <button type="submit" class="text-red-500 hover:text-red-400 cursor-pointer
                                        transition-colors">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg
                                            >
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-6 py-12 text-center text-slate-500">
                                    Váš košík je prázdný. <br>
                                    <a href="{{ route('home') }}" class="text-amber-500 hover:underline mt-2 inline-block">Vyberte si film</a>
                                </td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>

                    @if($cartItems->isNotEmpty())
                        <div class="mt-6 flex flex-col items-end gap-4 border-t border-slate-800 pt-6">
                            <div class="text-xl">
                                <span class="text-slate-400">Celkem k úhradě:</span>
                                <span class="text-3xl font-black text-amber-500 ml-4">{{ number_format($totalPrice, 0)
                                }} Kč</span>
                            </div>
                            <div class="flex gap-2">
                                <x-ui.action-button :href="route('home')">
                                    Pokračovat v nákupu
                                </x-ui.action-button>
                                <form action="" method="POST">
                                    @csrf <!-- TODO: dodělat form -->
                                    <x-ui.action-button href="">
                                        Zaplatit a stáhnout vstupenky
                                    </x-ui.action-button>
                                </form>

                            </div>
                        </div>
                    @endif
            @endauth
        </x-ui.card>
    </div>


</x-layout>

