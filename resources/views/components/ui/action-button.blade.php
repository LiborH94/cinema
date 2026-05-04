@props(['href' => null, 'type' => 'default'])

@php
    $baseClasses = 'inline-flex items-center justify-center border rounded-md p-2 text-sm font-bold
    transition-all duration-300 ease-in-out hover:scale-105 cursor-pointer';

    $themes = [
        'default' => 'bg-slate-950 border-slate-700 text-slate-400 hover:text-amber-500',
        'danger'  => 'bg-slate-950 border-slate-700 text-red-500/60 hover:text-red-500',
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
