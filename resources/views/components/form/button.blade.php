@props(['type' => 'submit'])
<button
    type="{{ $type }}"
    {{ $attributes->merge([
        'class' => 'bg-gray-600 px-6 py-3 rounded-lg font-bold transition-all duration-200
                   transform hover:scale-[1.02] active:scale-95 shadow-lg
                   flex items-center justify-center gap-2 disabled:opacity-50 disabled:cursor-not-allowed'
    ]) }}
>
    {{ $slot }}
</button>
