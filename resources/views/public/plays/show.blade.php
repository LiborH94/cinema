<x-layout>
    <x-ui.card>
        <div class="border-b border-slate-800 pb-6">
            <span class="text-xs font-bold text-amber-500 uppercase tracking-widest block mb-1">Rezervace vstupenek</span>
            <h2 class="text-3xl font-black text-white uppercase tracking-tight">
                {{ $play->movie->name }}
            </h2>
            <p class="text-sm text-slate-400 mt-1">
                <span class="font-semibold text-slate-300">{{ $play->hall->name }}</span>
                <span class="mx-2">•</span>
                {{ \Carbon\Carbon::parse($play->start_time)->format('H:i') }}
            </p>
        </div>

        <div class="flex flex-col p-8 lg:flex-row gap-6 items-start justify-center bg-slate-950/50">

            <div class="flex flex-col items-center grow w-full bg-slate-900/40 border border-slate-900 rounded-3xl p-8 backdrop-blur-sm">

                <div class="mb-10 w-full flex justify-center">
                    <x-halls.legend />
                </div>
                <div class="flex flex-col gap-2 w-full overflow-x-auto pb-4 justify-center items-center no-scrollbar">
                    @foreach($rows as $rowNumber => $rowSeats)
                        <div class="flex items-center gap-1 min-w-max">
                            <span class="text-slate-600 text-sm font-black w-6 text-center uppercase
                            tracking-wider">{{$rowNumber}}</span>

                            @foreach($rowSeats as $seat)
                                @php
                                    $isSold = in_array($seat->id, $soldSeatsIds);
                                    $isMine = in_array($seat->id, $myCartSeatsIds);
                                    $isOthers = in_array($seat->id, $othersCartSeatsIds);
                                    $isVip = $seat->type === \App\SeatType::VIP;
                                    $isDisabled = $seat->type === \App\SeatType::DISABLED;

                                    $seatType = match(true) {
                                        $isSold || $isOthers || $isDisabled => 'unavailable',
                                        $isMine => 'mine',
                                        $isVip => 'vip',
                                        default => 'free',
                                    };

                                    $baseClass = 'w-8 h-8 rounded text-sm font-bold transition-all duration-300
                                    flex items-center justify-center';

                                    $class = $baseClass ." ". match ($seatType) {
                                        'unavailable' => 'bg-red-800 text-slate-950 text-lg cursor-not-allowed border
                                                            border-slate-700/50',
                                        'mine' => 'bg-emerald-500 hover:bg-gray-300/50 text-emerald-950 scale-105
                                                    font-black cursor-pointer',
                                        'vip' => 'bg-yellow-500 text-transparent border border-amber-500/40
                                                    hover:bg-amber-500/50 cursor-pointer',
                                        'free' => 'bg-gray-300 text-transparent border border-slate-700/30
                                                    hover:border-slate-500/20 hover:bg-gray-300/50 cursor-pointer',
                                    };
                                @endphp
                                <div>
                                    @if($isMine)
                                        <form action="{{route('cart.remove', $play)}}" method="POST" class="m-0">
                                            @csrf
                                            @method('DELETE')
                                            <input type="hidden" name="seat_id" value="{{ $seat->id }}">
                                            <button type="submit" class="{{ $class }}" title="Vaše sedadlo: Řada {{ $rowNumber }}, Místo {{ $seat->column }}">✓</button>
                                        </form>
                                    @elseif($isSold || $isOthers)
                                        <button disabled class="{{ $class }}">×</button>
                                    @else
                                        <form action="{{ route('cart.add', $play) }}" method="POST" class="m-0">
                                            @csrf
                                            <input type="hidden" name="seat_id" value="{{ $seat->id }}">
                                            <button
                                                title="Řada: {{ $rowNumber }}, Místo: {{ $seat->column }}"
                                                type="submit"
                                                class="{{ $class }}">
                                                ×
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            @endforeach

                            <span class="text-slate-600 text-[11px] font-black w-6 text-center uppercase tracking-wider">{{$rowNumber}}</span>
                        </div>
                    @endforeach
                </div>
                <div class="mt-14 w-full max-w-md flex flex-col items-center">
                    <div class="h-1 w-full bg-slate-500 rounded-full"></div>
                    <p class="text-sm text-slate-500 uppercase font-black tracking-widest mt-3">Plátno</p>
                </div>
            </div>

            <div class="w-full lg:w-80 bg-slate-900/60 border border-slate-800 rounded-2xl p-6 shrink-0 shadow-2xl backdrop-blur-md">
                <div class="flex items-center justify-between mb-4 border-b border-slate-800 pb-3">
                    <h3 class="text-sm font-black text-white uppercase tracking-wider">
                        Zvolená místa
                    </h3>
                    <span class="bg-slate-800 text-slate-400 text-xs px-2 py-0.5 rounded-full font-bold">
                        {{ $myCartItems->count() }}
                    </span>
                </div>

                @if($myCartItems->isEmpty())
                    <div class="py-8 text-center">
                        <p class="text-slate-500 text-xs font-medium max-w-full mx-auto">
                            Kliknutím do plánku sálu si vyberte ideální sedadla.
                        </p>
                    </div>
                @else
                    <div class="divide-y divide-slate-800/40 max-h-64 overflow-y-auto pr-1 no-scrollbar">
                        @foreach($myCartItems as $item)
                            <div class="flex items-center justify-between py-3 group border-b border-dashed border-slate-800/50 last:border-none">
                                <div>
                                    <span class="block text-slate-200 font-extrabold text-xs tracking-wide">
                                        Řada {{ $item->seat->row }}, Sedadlo {{ $item->seat->column }}
                                    </span>
                                    <span
                                        class="text-xs font-bold uppercase tracking-wider
                                        {{ $item->seat->type === \App\SeatType::VIP ? 'text-amber-500' : 'text-slate-500' }}"
                                    >
                                            {{ $item->seat->type === \App\SeatType::VIP ? 'VIP Zóna' : 'Standard' }}
                                    </span>
                                </div>
                                <div class="flex items-center gap-3">
                                    <span class="text-white font-black text-xs bg-slate-800/80 px-2 py-1 rounded"
                                    >
                                        {{ $item->price }} Kč
                                    </span>
                                    <form action="{{ route('cart.remove', $play) }}" method="POST" class="m-0">
                                        @csrf
                                        @method('DELETE')
                                        <input type="hidden" name="seat_id" value="{{ $item->seat_id }}">
                                        <button class="text-3xl cursor-pointer text-red-600 hover:text-red-700/50"
                                        >
                                            ×
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="flex flex-col mt-6 pt-4 border-t border-slate-800">
                        <div class="flex justify-between items-baseline mb-4">
                            <span class="text-slate-500 uppercase text-[10px] font-black tracking-widest">K úhradě:</span>
                            <span class="text-2xl font-black text-amber-500 tracking-tight">{{ $totalCartPrice }} <span
                                    class="text-sm font-bold text-slate-400">Kč</span></span>
                        </div>

                        <x-ui.action-button :href="route('public.cart')">
                            Pokračovat k platbě
                        </x-ui.action-button>
                    </div>
                @endif
            </div>

        </div>

        <div class="mt-8 flex justify-start border-t border-slate-900 pt-4">
            <a href="{{ route('home') }}" class="text-xs font-bold text-slate-500 hover:text-amber-500
            transition uppercase tracking-wider">
                ← Zpět na výběr
            </a>
        </div>
    </x-ui.card>
</x-layout>
