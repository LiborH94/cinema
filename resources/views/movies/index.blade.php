<x-layout>
    <div class="flex justify-center p-6">
        @foreach(range(0, 10) as $day)
            @php
                $date = now()->addDays($day)->locale('cs');
            @endphp
            <a href=""
               class="text-md flex items-center justify-center p-4 w-24 font-black border border-gray-700
               bg-gray-900
                text-stone-300 hover:bg-gray-400 hover:text-white transition-all duration-200
                shadow-sm">
                {{$date->format('j.n.')}}
            </a>
        @endforeach
    </div>
    <div class="p-8 flex items-center justify-center flex-wrap">
        @foreach($movies as $movie)
            <div class="w-300 p-6 border border-b-gray-500 flex justify-between">
                <h3 class="text-2xl font-bold">{{$movie->name}}</h3>
                @if($movie->description)
                    <p>{{$movie->description}}</p>
                @endif
                <p>Počet volných míst</p>
            </div>
        @endforeach
    </div>
</x-layout>
