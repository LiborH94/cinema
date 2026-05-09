<x-layout>
    <x-ui.card
        back-url="{{route('admin.movies.show', $movie)}}"
        title="Upravit film: {{$movie->name}}"
    >
        <form action="{{route('admin.movies.update', $movie)}}" method="POST">
            @csrf
            @method('PATCH')
            <x-form.input name="name" label="Název filmu *" value="{{old('name', $movie->name ?? '')}}"/>
            <x-form.textarea name="description" label="Popis" :value="old('description', $movie->description)"/>
            <x-ui.action-button>Uložit</x-ui.action-button>
        </form>
    </x-ui.card>
</x-layout>
