<x-layout>
    <x-ui.card
        :back-url="route('admin.index')"
        title="Přehled představení"
    >
        <x-layout.calendar-nav :days="$days" route-name="admin.plays.index" />

        <div class="flex justify-between items-center mb-8">
            <div class="flex flex-col">
                <h3 class="text-xl font-bold text-stone-200">Seznam představení</h3>
                <p class="text-sm text-gray-500">Celkem nahraných představení: {{ $plays->count() }}</p>
            </div>
            <x-ui.action-button :href="route('admin.plays.create')">
                + Přidat nové představení
            </x-ui.action-button>
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
        <x-ui.line class="my-8" />
    </x-ui.card>
</x-layout>
