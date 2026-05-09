<x-layout>
    <x-ui.card
        back-url="{{route('admin.movies.index')}}"
        title="Vytvořit nový film"
    >
        <form action="{{route('admin.movies.store')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <x-form.input name="name" label="Název filmu *" placeholder="Spider-man"/>
            <x-form.textarea name="description" label="Popis"></x-form.textarea>
            <x-form.input name="image" type="file" label="Obrázek filmu" />
            <x-ui.action-button>Uložit</x-ui.action-button>
        </form>
    </x-ui.card>
</x-layout>
