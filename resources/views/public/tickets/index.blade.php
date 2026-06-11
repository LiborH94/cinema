<x-layout>
    <x-ui.card title="Seznam vašich vstupenek">
        @if($tickets->isEmpty())
            <div class="text-center py-8 text-slate-400">
                <p class="text-lg font-medium">Zatím nemáte zakoupené žádné vstupenky.</p>
                <a href="{{ route('home') }}" class="mt-4 inline-block text-amber-500 hover:underline text-sm font-bold">
                    Prohlédnout program kina
                </a>
            </div>
        @else
            <div class="space-y-6">
                @foreach($tickets->groupBy('play_id') as $playTickets)
                    @php
                        $firstTicket = $playTickets->first();
                        $play = $firstTicket->play;
                    @endphp

                    <div class="border border-slate-800 bg-slate-900/80 rounded-xl p-5 hover:border-slate-700/60
                    transition-all duration-200">
                        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pb-4 border-b border-slate-800/80">
                            <div>
                                <h3 class="font-black text-white text-xl hover:text-amber-500 transition-colors">
                                    {{ $play->movie->name }}
                                </h3>
                                <div class="text-sm text-slate-400 mt-1 flex items-center gap-2">
                                    <span>📅 {{ \Carbon\Carbon::parse($play->start_date)->format('d.m.Y') }}</span>
                                    <span class="text-slate-600">•</span>
                                    <span>🕒 {{ \Carbon\Carbon::parse($play->start_time)->format('H:i') }}</span>
                                </div>
                            </div>

                            <div class="text-left sm:text-right">
                                <span class="text-xs text-slate-500 block uppercase font-bold tracking-wider">Celkem za film</span>
                                <span class="text-xl font-black text-amber-500">
                                    {{ $playTickets->sum('price_paid') }} Kč
                                </span>
                            </div>
                        </div>

{{--                        <div class="my-4 flex justify-start gap-3">--}}
{{--                            <x-ui.action-button :href="route('public.tickets.download_play', $play)">--}}
{{--                                Stáhnout v PDF--}}
{{--                            </x-ui.action-button>--}}
{{--                        </div>--}}

                        <div class="mt-4">
                            <span class="text-xs text-slate-500 block uppercase font-bold tracking-wider mb-2">Vaše sedadla (kliknutím otevřete detail)</span>

                            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-3">
                                @foreach($playTickets as $ticket)
                                    <a href="{{ route('public.tickets.show', $ticket) }}" class="flex items-center justify-between px-4 py-2.5 rounded-lg bg-slate-800 border border-slate-700/50 hover:border-amber-500/50 hover:bg-slate-800/80 text-sm transition-all group">
                                        <span class="font-bold text-slate-200 group-hover:text-amber-500 transition-colors">
                                            Řada {{ $ticket->seat->row }}, Místo {{ $ticket->seat->column }}
                                        </span>
                                        <div class="flex items-center gap-2">
                                            <span class="text-xs text-slate-400 font-bold bg-slate-900/60 px-2 py-0.5 rounded border border-slate-700/30">
                                                {{ $ticket->price_paid }} Kč
                                            </span>
                                            <span class="text-slate-500 group-hover:text-amber-500 transition-colors">&rarr;</span>
                                        </div>
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </x-ui.card>
</x-layout>
