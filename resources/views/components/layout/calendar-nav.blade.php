@props(['days', 'routeName'])

<div class="flex justify-center gap-2 mb-10 overflow-x-auto pb-4 no-scrollbar">
    @foreach($days as $day)
        <a
            href="{{ route($routeName, ['date' => $day['formatted']]) }}"
            class="flex flex-col items-center min-w-[70px] p-2 rounded-lg border transition-all group
                    {{ $day['active']
                        ? 'border-amber-500 bg-amber-500 shadow-[0_0_15px_rgba(245,158,11,0.3)]'
                        : 'border-slate-800 bg-slate-900/50 hover:border-amber-500/50 hover:bg-slate-800'
                    }}"
        >
            <span class="text-[10px] uppercase font-bold
                {{ $day['active'] ? 'text-amber-950' : 'text-slate-500' }}">
                {{ $day['date']->locale('cs')->translatedFormat('D') }}
            </span>

            <span class="text-lg font-black
                {{ $day['active'] ? 'text-amber-950' : 'text-slate-200' }}">
                {{ $day['date']->format('j.') }}
            </span>

            <span class="text-sm font-bold
                {{ $day['active'] ? 'text-amber-900' : 'text-slate-500' }}">
                {{ $day['date']->locale('cs')->translatedFormat('M') }}
            </span>
        </a>
    @endforeach
</div>
