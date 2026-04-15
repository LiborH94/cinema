<div {{ $attributes->merge(['class' => 'mt-6 max-w-xl m-auto rounded-2xl shadow-2xl bg-slate-900 border
border-slate-800']) }}>
    @if(isset($title))
        <h2 class="text-3xl text-center p-8 font-black text-white uppercase tracking-tight border-b border-slate-800">
            {{ $title }}
        </h2>
    @endif

    <div class="p-6">
        {{ $slot }}
    </div>
</div>
