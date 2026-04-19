@props(['href' => '#'])

<a href="{{ $href }}"
    {{ $attributes->merge([
        'class' => 'inline-flex border bg-slate-950 rounded-md p-2 items-center text-slate-400 font-bold
                    text-md border-slate-700
                    transition-all duration-300 ease-in-out
                    hover:text-amber-500 hover:scale-105
                    group'
    ]) }}
>
        {{ $slot }}
</a>
