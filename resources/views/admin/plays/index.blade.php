<x-layout>
    <x-ui.card
        :back-url="route('admin.index')"
        title="Přehled představení"
    >
        <div class="flex justify-center gap-2 mb-10 overflow-x-auto pb-4 no-scrollbar">
            @foreach($days as $day)
                <a
                    href="{{ route('admin.plays.index', ['date' => $day['formatted']]) }}"
                    class="flex flex-col items-center min-w-[70px] p-2 rounded-lg border transition-all group
                    {{ $day['active']
                        ? 'border-amber-500 bg-amber-500 shadow-[0_0_15px_rgba(245,158,11,0.3)]'
                        : 'border-slate-800 bg-slate-900/50 hover:border-amber-500/50 hover:bg-slate-800'
                    }}"
                >
                    <span class="text-[10px] uppercase font-bold
                        {{ $day['active'] ? 'text-amber-950' : 'text-slate-500' }}">
                        {{ $day['date']->locale('cs')->translatedFormat('D') }}
                    </span>

                    <span class="text-lg font-black
                        {{ $day['active'] ? 'text-amber-950' : 'text-slate-200' }}">
                        {{ $day['date']->format('j.') }}
                    </span>

                    <span class="text-sm font-bold
                        {{ $day['active'] ? 'text-amber-900' : 'text-slate-500' }}">
                        {{ $day['date']->locale('cs')->translatedFormat('M') }}
                    </span>
                </a>
            @endforeach
        </div>
        @if($plays->isEmpty())
            <div class="p-8 text-center">
                <h2 class="text-xl font-bold text-gray-500">
                    Zatím zde nejsou žádná představení
                </h2>
            </div>
        @else
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead class="bg-slate-800 border-b border-b-gray-600">
                    <tr>
                        <th class="p-4 font-semibold">
                            Název filmu
                        </th>

                        <th class="p-4 font-semibold text-center">
                            Začátek
                        </th>

                        <th class="p-4 font-semibold text-right">
                            Akce
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($plays as $play)
                        <tr class="border-b border-b-gray-600 hover:bg-slate-700/50 transition">
                            <td class="p-4">
                                <a
                                    href="{{ route('admin.plays.show', $play) }}"
                                    class="flex items-center gap-3 text-sm text-gray-300 hover:text-amber-500 font-medium transition"
                                >
                                    @if($play->movie->image_path)
                                        <div class="w-12 h-16 shrink-0 bg-gray-800 rounded-md overflow-hidden shadow-md">
                                            <img
                                                class="w-full h-full object-cover"
                                                src="{{ asset('storage/' . $play->movie->image_path) }}"
                                                alt="{{ $play->movie->name }}">
                                        </div>
                                    @endif

                                    <span>{{ $play->movie->name }}</span>
                                </a>
                            </td>
                            <td class="p-4 text-center text-gray-300">
                                {{ \Carbon\Carbon::parse($play->start_time)->format('H:i') }}
                            </td>
                            <td class="p-4">
                                <div class="flex justify-end items-center gap-2">

                                    <x-ui.action-button
                                        :href="route('admin.plays.show', $play)"
                                        class="text-sm"
                                    >
                                        Zobrazit
                                    </x-ui.action-button>

                                    <form
                                        action="{{ route('admin.plays.destroy', $play) }}"
                                        method="POST"
                                        onsubmit="return confirm(
                                            'Opravdu chcete toto představení smazat? Smažete zároveň všechny vstupenky na dané představení.'
                                        )"
                                    >
                                        @csrf
                                        @method('DELETE')

                                        <x-ui.action-button type="danger">
                                            Odstranit
                                        </x-ui.action-button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        @endif
        <div class="p-4 border-t border-t-gray-600 bg-slate-850 text-center">
            <x-ui.action-button :href="route('admin.plays.create')">
                + Vytvořit nové představení
            </x-ui.action-button>
        </div>

    </x-ui.card>
</x-layout>
