<x-layout>
    <x-ui.card
        back-url="{{route('admin.halls.index')}}"
        title="Vytvořit sál"
    >
        <form
            action="{{route('admin.halls.store')}}"
            method="POST"
            class="p-6"
        >
            @csrf
            <x-form.input name="name" label="Název sálu"/>
            <x-form.input class="max-w-30" name="rows_count" type="number" min="1" label="Počet řad"/>
            <x-form.input class="max-w-30" name="columns_count" type="number" min="1" label="Počet sedadel v řadě" />
            <div class="flex justify-center mt-6">
                <x-ui.action-button type="submit">Uložit</x-ui.action-button>
            </div>
        </form>
    </x-ui.card>
</x-layout>
