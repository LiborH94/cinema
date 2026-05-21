@props(['days', 'routeName'])

<div class="flex justify-start md:justify-center gap-2 mb-6 md:mb-10 overflow-x-auto pb-4 no-scrollbar snap-x
snap-mandatory px-2 md:px-0">
    @foreach($days as $day)
        <a
            href="{{ route($routeName, ['date' => $day['formatted']]) }}"
            class="flex flex-col items-center min-w-16 md:min-w-18 p-2 rounded-lg border transition-all group
            snap-mini snap-center
                    {{ $day['active']
                        ? 'border-amber-500 bg-amber-500'
                        : 'border-slate-800 bg-slate-900/50 hover:border-amber-500/50 hover:bg-slate-800'
                    }}"
        >
            <span class="text-[9px] md:text-[10px] uppercase font-bold tracking-wider
                {{ $day['active'] ? 'text-amber-950' : 'text-slate-500' }}">
                {{ $day['date']->locale('cs')->translatedFormat('D') }}
            </span>

            <span class="text-base md:text-lg font-black my-0.5
                {{ $day['active'] ? 'text-amber-950' : 'text-slate-200' }}">
                {{ $day['date']->format('j.') }}
            </span>

            <span class="text-xs md:text-sm font-bold
                {{ $day['active'] ? 'text-amber-900' : 'text-slate-500' }}">
                {{ $day['date']->locale('cs')->translatedFormat('M') }}
            </span>
        </a>
    @endforeach
</div>
