@props([
    'title' => null,
    'backUrl' => null,
])
<div {{ $attributes->merge(['class' => 'max-w-7xl my-6 text-gray-300 m-auto shadow-2xl
        bg-slate-700/30 backdrop-blur-sm border border-slate-700/50 rounded-lg relative']) }}>

    @if($backUrl)
        <a href="{{$backUrl}}"
           class="absolute top-4 right-4 text-gray-500 hover:text-white transition-colors duration-200 p-2 hover:bg-white/10 rounded-full"
           title="Zavřít">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </a>
    @endif
    @if(isset($title))
        <h2 class="text-xl text-center py-6 font-black text-gray-300 uppercase tracking-tight border-b border-slate-700/50">
            {{ $title }}
        </h2>
    @endif


    <div class="p-6">
        {{ $slot }}
    </div>
</div>
