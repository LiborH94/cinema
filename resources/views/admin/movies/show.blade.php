<x-layout>
    <x-ui.card
        back-url="{{route('admin.movies.index')}}"
        title="{{$movie->name}}"
    >
        <div class="flex flex-col md:flex-row gap-8">

            @if($movie->image_path)
                <div class="md:w-1/6 shrink-0">
                    <img src="{{ asset('storage/' . $movie->image_path) }}"
                         alt="{{ $movie->name }}"
                         class="w-full rounded-lg shadow-xl border border-slate-700/50 object-cover">
                </div>
            @else
                <div class="md:w-1/6 flex flex-col items-center justify-center bg-slate-900 text-slate-700">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-12 h-12 mb-2 opacity-20">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 0 0 1.5-1.5V6a1.5 1.5 0 0 0-1.5-1.5H3.75A1.5 1.5 0 0 0 2.25 6v12a1.5 1.5 0 0 0 1.5 1.5Zm10.5-11.25h.008v.008h-.008V8.25Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                    </svg>
                    <span class="text-[10px] uppercase font-black tracking-widest opacity-30">Plakát chybí</span>
                </div>
            @endif

            <div class="grow">
                <p class="text-gray-300 leading-relaxed mb-8 text-lg">
                    {{ $movie->description }}
                </p>

                <div class="flex flex-wrap items-center gap-4">
                    <x-ui.action-button :href="route('admin.movies.edit', $movie)">
                        Upravit film
                    </x-ui.action-button>

                    <form action="{{ route('admin.movies.destroy', $movie) }}" method="POST"
                          onsubmit="return confirm('Opravdu chcete tento film smazat?')"
                          class="inline">
                        @csrf
                        @method('DELETE')
                        <x-ui.action-button type="danger">
                            Odstranit
                        </x-ui.action-button>
                    </form>
                </div>
            </div>
        </div>
    </x-ui.card>
</x-layout>
