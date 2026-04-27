<x-layout>
    <x-ui.card title="Vytvořit nový film">
        <form action="{{route('admin.movies.update', $movie)}}" method="POST">
            @csrf
            @method('PATCH')
            <x-form.input name="name" label="Název filmu *" value="{{old('name', $movie->name ?? '')}}"/>
            <x-form.textarea name="description" label="Popis">{{old('description', $movie->description ?? '')}}</x-form.textarea>
            <x-form.button>Uložit</x-form.button>
        </form>
    </x-ui.card>
</x-layout>
