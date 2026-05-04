<x-layout>
    <x-ui.card title="Upravit film: {{$movie->name}}">
        <form action="{{route('admin.movies.update', $movie)}}" method="POST">
            @csrf
            @method('PATCH')
            <x-form.input name="name" label="Název filmu *" value="{{old('name', $movie->name ?? '')}}"/>
            <x-form.textarea name="description" label="Popis">{{old('description', $movie->description ?? '')}}</x-form.textarea>
            <x-ui.action-button>Uložit</x-ui.action-button>
        </form>
    </x-ui.card>
</x-layout>
