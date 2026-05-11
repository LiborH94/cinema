<x-layout>
    <x-ui.card :title="'Výběr sedadel: ' . $play->movie->name">
        <div class="flex flex-col items-center p-8 bg-slate-950">

            <x-halls.legend />

            <div class="flex flex-col">
                @foreach($rows as $rowNumber => $rowSeats)
                    <div class="flex justify-center gap-1">
                        @foreach($rowSeats as $seat)
                            @php
                                $isSold = in_array($seat->id, $soldSeatsIds);
                                $isMine = in_array($seat->id, $myCartSeatsIds);
                                $isOthers = in_array($seat->id, $othersCartSeatsIds);

                                $class = 'w-8 h-8 rounded transition-all ';
                                if ($isSold || $isOthers) {
                                    $class .= 'bg-red-800 text-white opacity-50 cursor-not-allowed';
                                } elseif ($isMine) {
                                    $class .= 'bg-green-500 hover:bg-green-600 hover:scale-110 text-white';
                                } else {
                                    $class .= 'bg-gray-200 hover:bg-blue-400';
                                }
                            @endphp

                            @if($isMine)
                                <form action="{{route('cart.remove', $play)}}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <input type="hidden" name="seat_id" value="{{ $seat->id }}">
                                    <button type="submit" class="{{ $class }}">✓</button>
                                </form>

                            @elseif($isSold || $isOthers)
                                <button disabled class="{{ $class }}">✕</button>

                            @else
                                <form action="{{ route('cart.add', $play) }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="seat_id" value="{{ $seat->id }}">
                                    <button type="submit" class="{{ $class }}"></button>
                                </form>
                            @endif
                        @endforeach
                    </div>
                @endforeach
            </div>

            <div class="mt-12 w-200 max-w-md flex flex-col items-center">
                <div class="h-1 w-full bg-gray-600 rounded-full shadow-[0_0_15px_rgba(255,255,255,0.1)]"></div>
                <p class="text-md text-slate-600 uppercase tracking-wider mt-3">Plátno</p>

                <x-ui.action-button :href="route('public.plays.showPlayDetails', $play)" class="mt-6">
                    Zpět na detail filmu
                </x-ui.action-button>
            </div>
        </div>
    </x-ui.card>
</x-layout>
