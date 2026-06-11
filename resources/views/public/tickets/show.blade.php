<x-layout>
    <x-ui.card title="Detail vaší vstupenky">

        <div class="max-w-xl mx-auto my-4">

            <div class="border border-slate-800 bg-slate-900/40 rounded-2xl overflow-hidden shadow-xl">

                <div class="p-6 bg-gradient-to-br from-slate-900 to-slate-800 border-b border-slate-800">
                    <span class="text-xs text-amber-500 uppercase font-bold tracking-wider block mb-1">Představení</span>
                    <h2 class="font-black text-2xl text-white">
                        {{ $ticket->play->movie->name }}
                    </h2>

                    <div class="grid grid-cols-2 gap-4 mt-4 text-sm text-slate-300">
                        <div class="flex items-center gap-2">
                            <span>📅 Datum:</span>
                            <strong class="text-white">{{ \Carbon\Carbon::parse($ticket->play->start_date)->format('d.m.Y') }}</strong>
                        </div>
                        <div class="flex items-center gap-2">
                            <span>🕒 Začátek:</span>
                            <strong class="text-white">{{ \Carbon\Carbon::parse($ticket->play->start_time)->format('H:i') }}</strong>
                        </div>
                    </div>
                </div>

                <div class="p-6 bg-slate-900/20 grid grid-cols-1 md:grid-cols-3 gap-6 items-center">

                    <div class="md:col-span-2 space-y-3">
                        <div>
                            <span class="text-xs text-slate-500 uppercase font-bold block">Místo k sezení</span>
                            <div class="text-lg font-bold text-white mt-0.5">
                                Řada <span class="text-amber-500 text-xl">{{ $ticket->seat->row }}</span>,
                                Místo <span class="text-amber-500 text-xl">{{ $ticket->seat->column }}</span>
                            </div>
                        </div>

                        <div>
                            <span class="text-xs text-slate-500 uppercase font-bold block">Cena vstupenky</span>
                            <div class="text-lg font-black text-white mt-0.5">
                                {{ $ticket->price_paid}} Kč
                            </div>
                        </div>

                        <div>
                            <span class="text-xs text-slate-500 uppercase font-bold block">Identifikační kód</span>
                            <div class="text-xs font-mono text-slate-400 mt-0.5">
                                ID: {{ $ticket->id }}
                            </div>
                        </div>
                    </div>

                    <div class="flex flex-col items-center justify-center bg-white p-3 rounded-xl shadow-inner mx-auto md:mx-0 w-[120px] h-[120px]">
                        <img src="https://api.qrserver.com/v1/create-qr-code/?size=120x120&data={{ $ticket->id }}" alt="QR Kód lístku" class="w-full h-full">
                    </div>

                </div>

                <div class="p-4 bg-slate-950/60 border-t border-slate-800/60 flex flex-col sm:flex-row justify-between items-center gap-2 text-xs text-slate-500">
                    <div>Vystaveno pro: <span class="text-slate-300 font-medium">{{ auth()->user()->name }}</span></div>
                    <div>Děkujeme za nákup a přejeme příjemnou zábavu!</div>
                </div>

            </div>

            <div class="mt-6 flex justify-between items-center">
                <a href="{{ route('public.tickets.index') }}" class="text-sm text-slate-400 hover:text-white transition-colors flex items-center gap-1">
                    &larr; Zpět na seznam lístků
                </a>

{{--                <x-ui.action-button :href="route('public.tickets.downloadOne', $ticket)">--}}
{{--                    Stáhnout PDF--}}
{{--                </x-ui.action-button>--}}
            </div>

        </div>

    </x-ui.card>
</x-layout>
