<x-layout>
    <x-ui.card back-url="{{ route('admin.plays.index') }}">
        <div class="flex flex-col gap-6">

            <div>
                <h1 class="text-3xl font-extrabold text-white mt-1">{{ $play->movie->name }}</h1>
                <p class="text-slate-400 mt-2">
                    📅 {{ \Carbon\Carbon::parse($play->start_date)->format('d. m. Y') }}
                    🕒 {{ \Carbon\Carbon::parse($play->start_time)->format('H:i') }}
                    📍 Sál: <span class="text-slate-200 font-medium">{{ $play->hall->name }}</span>
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="bg-slate-900 border border-slate-800 rounded-xl p-5 flex flex-col justify-center">
                    <span class="text-xs text-slate-400 uppercase font-semibold block">Celková tržba</span>
                    <div class="text-2xl font-bold text-emerald-500 mt-1">
                        {{ $totalRevenue }} Kč
                    </div>
                </div>

                <div class="bg-slate-900 border border-slate-800 rounded-xl p-5 flex flex-col justify-center">
                    <span class="text-xs text-slate-400 uppercase font-semibold block">Prodané vstupenky</span>
                    <div class="text-2xl font-bold text-white mt-1">
                        {{ $play->tickets_count }} / {{ $seatsCountTotal }}
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-1 gap-2">
                <div class="lg:col-span-2 bg-slate-900 border border-slate-800 rounded-xl p-6 flex flex-col justify-between">
                    <div>
                        <h3 class="text-lg font-bold text-white mb-4">Seznam diváků</h3>

                        <div class="overflow-x-auto rounded-lg border border-slate-800">
                            <table class="w-full text-left text-sm text-slate-300 border-collapse">
                                <thead class="bg-slate-800/80 text-slate-400 uppercase text-xs">
                                <tr>
                                    <th class="p-3 font-semibold tracking-wider">Uživatel</th>
                                    <th class="p-3 font-semibold tracking-wider">Sedadlo</th>
                                    <th class="p-3 font-semibold tracking-wider text-center">Typ</th>
                                    <th class="p-3 font-semibold tracking-wider text-right">Cena</th>
                                </tr>
                                </thead>
                                <tbody class="divide-y divide-slate-800/60 bg-slate-900/40">

                                @forelse($tickets as $ticket)
                                    <tr class="hover:bg-slate-800/30 transition-colors duration-150">

                                        <td class="p-3 font-medium text-white whitespace-nowrap py-4">
                                            {{ $ticket->user->name ?? 'Anonymní zákazník' }}
                                            @if(isset($ticket->user->email))
                                                <span class="block text-xs text-slate-500 font-normal mt-0.5">{{ $ticket->user->email }}</span>
                                            @endif
                                        </td>

                                        <td class="p-3 text-slate-300 py-4">
                                            Řada {{ $ticket->seat->row }}, Místo {{ $ticket->seat->column }}
                                        </td>

                                        <td class="p-3 text-center py-4">
                                            @if($ticket->is_vip)
                                                <span class="inline-block bg-amber-500/10 text-amber-500 text-xs px-2 py-0.5 rounded font-bold uppercase border border-amber-500/20">
                                                        VIP
                                                    </span>
                                            @else
                                                <span class="inline-block bg-slate-800 text-slate-400 text-xs px-2 py-0.5 rounded font-medium uppercase border border-slate-700">
                                                        Standard
                                                    </span>
                                            @endif
                                        </td>

                                        <td class="p-3 text-right font-semibold text-slate-100 py-4 whitespace-nowrap">
                                            {{ $ticket->price_paid }} Kč
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="p-8 text-center text-slate-500 italic">
                                            Na toto představení si ještě nikdo nekoupil vstupenku.
                                        </td>
                                    </tr>
                                @endforelse

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </x-ui.card>
</x-layout>
