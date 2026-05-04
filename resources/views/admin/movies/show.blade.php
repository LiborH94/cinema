<x-layout>
    <x-ui.card title="{{$movie->name}}">
        <h2>{{$movie->description}}</h2>
        <x-ui.action-button :href="route('admin.movies.edit', $movie)">Upravit film</x-ui.action-button>
        <form class="py-4" action="{{ route('admin.movies.delete', $movie) }}" method="POST"
              onsubmit="return confirm('Opravdu chcete tento film smazat?')">
            @csrf
            @method('DELETE')
            <x-ui.action-button class="bg-red-700 hover:bg-red-800 text-gray-300">Odstranit</x-ui.action-button>
        </form>
    </x-ui.card>
</x-layout>
