<div {{ $attributes->merge(['class' => 'mt-6 text-gray-300 max-w-4xl m-auto rounded-2xl shadow-2xl bg-slate-950 border
        border-slate-800']) }}>
    @if(isset($title))
        <h2 class="text-xl text-center py-6 font-black text-gray-300 uppercase tracking-tight border-b
        border-slate-800">
            {{ $title }}
        </h2>
    @endif

    <div class="p-6">
        {{ $slot }}
    </div>
</div>
