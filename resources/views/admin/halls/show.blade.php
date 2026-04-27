<x-layout>
    <x-ui.card title="Plán sálu: {{ $hall->name }}">
        <div class="flex flex-col gap-3 items-center p-8 bg-slate-950">
            {{-- Procházíme seskupená data z Controlleru --}}
            @foreach($rows as $cislo_rady => $sedadla_v_rade)
                <div class="flex gap-2 items-center">
                    {{-- Levý popisek řady --}}
                    <span class="text-slate-500 text-[10px] w-4">{{ $cislo_rady }}</span>

                    {{-- Teď procházíme ten "vnitřek", tedy konkrétní sedadla v téhle řadě --}}
                    @foreach($sedadla_v_rade as $sedadlo)
                        <button class="hover:bg-amber-500 w-8 h-8 rounded bg-slate-800 border border-slate-700 text-slate-400
                        text-[10px]">
                            {{ $sedadlo->column }}
                        </button>
                    @endforeach

                    {{-- Pravý popisek řady --}}
                    <span class="text-slate-500 text-[10px] w-4">{{ $cislo_rady }}</span>
                </div>
            @endforeach
            <div class="mt-12 w-200 max-w-md flex flex-col items-center">
                <div class="h-1 w-full bg-gray-600 rounded-full"></div>
                <p class="text-md text-slate-600 uppercase tracking-wider mt-3">Plátno</p>
            </div>

        </div>
    </x-ui.card>
</x-layout>
