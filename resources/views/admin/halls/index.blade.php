<x-layout>
    <div class="p-6">
        @if($halls->count())
            @foreach($halls as $hall)
                <div>
                    <h2>{{$hall->name}}</h2>
                </div>
            @endforeach
        @else
            <div>
                <p>Žádné sály</p>
            </div>
        @endif
        <div>
            <a href="{{route('admin.halls.create')}}">Vytvořit nový sál</a>
        </div>
    </div>
</x-layout>
