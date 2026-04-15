@props(['type' => 'submit'])

<button
    type="{{ $type }}"
    {{ $attributes->merge([
        'class' => 'bg-amber-500 text-black px-8 py-3 rounded-xl font-black uppercase tracking-widest
                    transition-all duration-200 shadow-[0_0_20px_rgba(245,158,11,0.2)]
                    hover:bg-amber-400 hover:scale-[1.03] hover:shadow-[0_0_25px_rgba(245,158,11,0.4)]
                    active:scale-95 cursor-pointer outline-none'
    ]) }}
>
    {{ $slot }}
</button>
