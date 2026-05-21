<x-layout>
    <x-ui.card
        back-url="{{route('admin.index')}}"
        title="Přehled sálů"
    >

        <div class="flex justify-between items-center mb-8">
            <div class="flex flex-col">
                <h3 class="text-xl font-bold text-stone-200">Seznam sálů</h3>
                <p class="text-sm text-gray-500">Celkem sálů: {{ $halls->count() }}</p>
            </div>
            <x-ui.action-button :href="route('admin.halls.create')">
                + Přidat nový sál
            </x-ui.action-button>
        </div>
        @if($halls->isEmpty())
            <div class="p-8 text-center">
                <h2 class="text-xl font-bold text-gray-500">Zatím zde nejsou žádné položky</h2>
            </div>
        @else
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead class="bg-slate-800 border-b border-b-gray-600">
                    <tr>
                        <th class="p-4 font-semibold">Název sálu</th>
                        <th class="p-4 font-semibold text-center ">Kapacita</th>
                        <th class="p-4 font-semibold text-right">Akce</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($halls as $hall)
                        <tr class="border-b border-b-gray-600 hover:bg-slate-700/50 transition">
                            <td class="p-4">
                                <a href="{{ route('admin.halls.show', $hall) }}" class="text-gray-300
                                hover:text-amber-500 font-medium">
                                    {{ $hall->name }}
                                </a>
                            </td>
                            <td class="p-4 text-center">
                                <p>{{ $hall->getTotalCapacity() }} sedadel</p>
                            </td>
                            <td class="p-4 flex justify-end items-center gap-2">
                                <x-ui.action-button
                                    :href="route('admin.halls.show', $hall)"
                                    class="text-sm"
                                >Zobrazit
                                </x-ui.action-button>
                                <x-ui.action-button
                                    :href="route('admin.halls.edit', $hall)"
                                    class="text-sm"
                                >Upravit
                                </x-ui.action-button>
                                <form action="{{route('admin.halls.destroy', $hall)}}"
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
        <x-ui.line class="my-8" />
    </x-ui.card>
</x-layout>
