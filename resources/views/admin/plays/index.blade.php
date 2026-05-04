<x-layout>
    <x-ui.card title="Přehled představení">
        @if($plays->isEmpty())
            <div class="p-8 text-center">
                <h2 class="text-xl font-bold text-gray-500">Zatím zde nejsou žádné představení</h2>
            </div>
        @else
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead class="bg-slate-800 border-b border-b-gray-600">
                    <tr>
                        <th class="p-4 font-semibold">Název filmu</th>
                        <th class="p-4 font-semibold text-center ">Začátek</th>
                        <th class="p-4 font-semibold text-right">Počet volných míst</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($plays as $play)
                        <tr class="border-b border-b-gray-600 hover:bg-slate-700/50 transition">
                            <td class="p-4">
                                <a href="{{ route('admin.plays.show', $play) }}" class="text-gray-300
                                hover:text-amber-500 font-medium">
                                    {{$play->movie->name}}
                                </a>
                            </td>
                            <td class="p-4 text-center">
                                <p>{{$play->start_time}}</p>
                            </td>
                            <td class="p-4 flex justify-end items-center gap-2">
                                <x-ui.action-button
                                    :href="route('admin.plays.show', $play)"
                                    class="text-sm"
                                >Zobrazit
                                </x-ui.action-button>
                                <x-ui.action-button
                                    href=""
                                    class="text-sm"
                                >Upravit
                                </x-ui.action-button>
                                <form action=""
                                      method="POST"
                                >
                                    @csrf
                                    @method('DELETE')
                                    <x-ui.action-button type="danger">Odstranit</x-ui.action-button>
                                </form>
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
