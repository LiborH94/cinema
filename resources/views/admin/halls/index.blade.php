<x-layout>
    <x-ui.card title="Přehled sálů">
        @if(!$halls->count())
            <h2 class="text-center text-xl font-bold">Zatím zde nejsou žádné položky</h2>
        @else
            @foreach($halls as $hall)
                <h2>{{$hall->name}}</h2>
            @endforeach
        @endif
        <div class="p-4">
            <x-ui.link href="{{route('admin.halls.create')}}">Vytvořit nový sál</x-ui.link>
        </div>
    </x-ui.card>
</x-layout>
