<x-layout>
    <x-ui.card title="Plán sálu: {{ $hall->name }}">
        <div class="flex flex-col gap-1 items-center p-8 bg-slate-950">
            @foreach($rows as $rowNumber => $seatsInRow)
                <div class="flex gap-1 items-center">
                    <span class="text-slate-500 text-xs w-4">{{$rowNumber}}</span>
                    @foreach($seatsInRow as $seat)
                        <button class="hover:bg-amber-500 w-8 h-8 bg-slate-800 border border-slate-700
                        text-slate-400 text-xs">
                            <!-- {{ $seat->column }} -->
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
