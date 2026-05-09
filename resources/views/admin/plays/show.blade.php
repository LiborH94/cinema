<x-layout>
    <x-ui.card
        back-url="{{route('admin.plays.index')}}"
        title="Detaily představení"
    >
        <div>
            <h3>{{$play->movie->name}}</h3>
        </div>
    </x-ui.card>
</x-layout>
