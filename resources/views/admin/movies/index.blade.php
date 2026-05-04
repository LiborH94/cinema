<x-layout>
    <x-ui.card title="Přehled filmů">
        @if($movies->isEmpty())
            <h2 class="text-center text-xl font-bold">Zatím zde nejsou žádné položky</h2>
        @else
            @foreach($movies as $movie)
                <x-ui.action-button :href="route('admin.movies.show', $movie)">{{$movie->name}}</x-ui.action-button>
            @endforeach
        @endif
        <x-ui.line />
        <div class="p-4">
            <x-ui.action-button :href="route('admin.movies.create')">Vytvořit nový film</x-ui.action-button>
        </div>
    </x-ui.card>
</x-layout>
