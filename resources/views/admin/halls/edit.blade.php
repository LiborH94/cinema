<x-layout>
    <x-ui.card
        back-url="{{route('admin.halls.index')}}"
        title="Upravit sál: {{ $hall->name }}"
    >
        <div class="flex flex-col items-center p-8 bg-slate-950">
            <div class="mb-10 w-full flex justify-center">
                <x-halls.legend />
            </div>
            @foreach($rows as $rowNumber => $seatsInRow)
                <div class="flex gap-1 items-center">
                    <span class="text-slate-500 text-xs w-4">{{$rowNumber}}</span>
                    <div class="flex gap-1 items-center">
                        @foreach($seatsInRow as $seat)
                            @php
                                $classes = match($seat->type->value) {
                                    'vip' => 'bg-yellow-500 hover:bg-red-800/40 text-white',
                                    'disabled' => 'bg-red-800 hover:bg-gray-200/60 text-white',
                                    default => 'bg-gray-200 hover:bg-yellow-400/40 text-black',
                                };
                            @endphp
                            <form action="{{ route('admin.seats.toggle', $seat) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <button class="w-8 h-8 rounded transition-all cursor-pointer {{ $classes }}"
                                        title="Řada {{ $rowNumber }}, Sedadlo {{ $seat->column }}">
                                </button>
                            </form>
                        @endforeach
                    </div>
                    <span class="text-slate-500 text-xs w-4 text-right">{{$rowNumber}}</span>
                </div>
            @endforeach
            <div class="mt-12 w-200 max-w-md flex flex-col items-center">
                <div class="h-1 w-full bg-gray-600 rounded-full"></div>
                <p class="text-md text-slate-600 uppercase tracking-wider mt-3">Plátno</p>
                <x-ui.action-button :href="route('admin.halls.index')" class="mt-6">Zpět na seznam</x-ui.action-button>
            </div>
        </div>
    </x-ui.card>
</x-layout>
