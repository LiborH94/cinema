<x-layout>
    <x-card title="Vytvořit sál">
        <a href="" class="">zpět</a>
        <form
            action="{{route('admin.halls.store')}}"
            method="POST"
            class="p-6"
        >
            @csrf
            <x-form.input name="name" label="Název sálu"/>
            <x-form.input name="rows_count" label="Počet řad"/>
            <x-form.input name="columns_count" label="Počet sedadel v řadě" />
            <div class="flex justify-center mt-6">
                <x-form.button>Uložit</x-form.button>
            </div>
        </form>
    </x-card>
</x-layout>
