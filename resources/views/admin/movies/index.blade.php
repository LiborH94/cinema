<x-layout>
    <x-ui.card title="Přehled filmů">
        @if(!$movies->count())
            <h2 class="text-center text-xl font-bold">Zatím zde nejsou žádné položky</h2>
        @else
            @foreach($movies as $movie)
                <x-ui.link href="{{route('admin.movies.show', $movie)}}">{{$movie->name}}</x-ui.link>
            @endforeach
        @endif
        <x-ui.line />
        <div class="p-4">
            <x-ui.link href="{{route('admin.movies.create')}}">Vytvořit nový film</x-ui.link>
        </div>
    </x-ui.card>
</x-layout>
