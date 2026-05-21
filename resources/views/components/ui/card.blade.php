@props([
    'title' => null,
    'backUrl' => null,
])

<div {{ $attributes->merge(['class' => 'w-full max-w-7xl mx-auto my-3 md:my-7 text-gray-300 shadow-2xl bg-slate-700/30
 backdrop-blur-sm border border-slate-700/50 rounded-lg relative']) }}>

    @if($backUrl)
        <a href="{{$backUrl}}"
           class="text-gray-500 hover:text-white transition-colors duration-200 hover:bg-white/10 rounded-full"
           title="Zavřít">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-5 h-5 md:w-6 md:h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </a>
    @endif

    @if(isset($title))
        <h2 class="text-lg md:text-xl text-center py-4 md:py-6 px-12 font-black text-gray-300 uppercase tracking-tight border-b border-slate-700/50">
            {{ $title }}
        </h2>
    @endif

    <div class="p-2 md:p-6">
        {{ $slot }}
    </div>
</div>
