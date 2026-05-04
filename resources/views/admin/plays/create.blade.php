<x-layout>
    <x-ui.card title="Vytvořit nové představení">
        <form action="{{ route('admin.plays.store') }}" method="POST" class="flex flex-col gap-4">
            @csrf

            <x-form.select
                name="movie_id"
                label="Film"
                :options="$movies->pluck('name', 'id')"
            />
            <x-form.select
                name="hall_id"
                label="Sál"
                :options="$halls->pluck('name', 'id')"
            />
            <x-form.input
                label="Datum"
                name="start_date"
                type="date"
            />
            <x-form.input
                label="Čas"
                name="start_time"
                type="time"
            />
            <div class="grid grid-cols-2 gap-4">
                <x-form.input
                    label="Cena za sedadlo"
                    name="standard_price"
                    type="number"
                    placeholder="150"
                />
                <x-form.input
                    label="Cena za VIP sedadlo"
                    name="vip_price"
                    type="number"
                    placeholder="200"
                />
            </div>
            <div class="flex gap-4 mt-4">
                <x-ui.action-button type="submit">Vytvořit představení</x-ui.action-button>
                <a href="{{ route('admin.plays.index') }}" class="ml-auto text-slate-500 hover:text-slate-300 flex items-center">
                    Zrušit
                </a>
            </div>
        </form>
    </x-ui.card>
</x-layout>
