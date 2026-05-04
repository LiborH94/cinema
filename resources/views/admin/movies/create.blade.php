<x-layout>
    <x-ui.card title="Vytvořit nový film">
        <form action="{{route('admin.movies.store')}}" method="POST">
            @csrf
            <x-form.input name="name" label="Název filmu *" placeholder="Spider-man"/>
            <x-form.textarea name="description" label="Popis"></x-form.textarea>
            <x-ui.action-button>Uložit</x-ui.action-button>
        </form>
    </x-ui.card>
</x-layout>
