<x-layout>
    <x-ui.card title="Plán sálu: {{ $hall->name }}">
        <div class="flex flex-col gap-1 items-center p-8 bg-slate-950">
            <x-halls.legend />
            @foreach($rows as $rowNumber => $seatsInRow)
                <div class="flex gap-1 items-center">
                    <span class="text-slate-500 text-xs w-4">{{$rowNumber}}</span>
                    @foreach($seatsInRow as $seat)
                        @php
                            $classes = match($seat->type->value) {
                                'vip' => 'bg-yellow-500',
                                'disabled' => 'bg-red-800',
                                default => 'bg-gray-300',
                            };
                        @endphp
                        <button
                            title="Řada {{ $rowNumber }}, Sedadlo {{ $seat->column }}"
                            class="w-8 h-8 hover:bg-slate-500/50 border border-slate-700 {{$classes}}">
                        </button>
                    @endforeach
                    <span class="text-slate-500 text-xs w-4 text-right">{{$rowNumber}}</span>
                </div>
            @endforeach
            <div class="mt-12 w-200 max-w-md flex flex-col items-center">
                <div class="h-1 w-full bg-gray-600 rounded-full"></div>
                <p class="text-md text-slate-600 uppercase tracking-wider mt-3">Plátno</p>
            </div>

        </div>
    </x-ui.card>
</x-layout>
