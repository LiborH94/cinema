@props(['href' => null, 'type' => 'default'])

@php
    $baseClasses = 'inline-flex items-center justify-center border rounded-md px-6 tracking-wide p-2 text-sm font-bold
    transition-all duration-300 ease-in-out hover:scale-105 cursor-pointer text-transform: uppercase';

    $themes = [
        'default' => 'bg-slate-950 border-slate-700 text-slate-400 hover:text-amber-500',
        'danger'  => 'bg-slate-950 border-slate-700 text-red-500/60 hover:text-red-500',
        'amber' => 'text-slate-950 !bg-amber-500 hover:!bg-amber-600 border-none',
        'none'    => ''
    ];

    $class = $baseClasses . ' ' . ($themes[$type] ?? $themes['default']);
@endphp

@if($href)
    <a href="{{ $href }}" {{ $attributes->merge(['class' => $class]) }}>
        {{ $slot }}
    </a>
@else
    <button {{ $attributes->merge(['class' => $class]) }}>
        {{ $slot }}
    </button>
@endif
