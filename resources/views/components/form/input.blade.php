@props([
    'label',
    'name',
    'type' => 'text',
    'placeholder' => '',
    'value' => ''
])

<div class="mb-5">
    @if($label)
        <label for="{{ $name }}" class="block text-sm font-bold text-stone-300 mb-2 ml-1">
            {{ $label }}
        </label>
    @endif

    <input
        type="{{ $type }}"
        id="{{ $name }}"
        name="{{ $name }}"
        value="{{ old($name, $value) }}"
        placeholder="{{ $placeholder }}"
        {{ $attributes->merge([
            'class' => 'w-50 px-4 py-2.5 bg-gray-800 text-stone-100 border border-gray-700 rounded-lg
                       outline-none transition duration-150 ease-in-out
                       placeholder:text-gray-600
                       focus:border-stone-500 focus:ring-2 focus:ring-stone-500/20 shadow-inner'
        ]) }}
    >

    {{-- Zobrazení chyb přímo pod inputem --}}
    @error($name)
    <p class="text-red-500 text-xs mt-2 ml-1 font-medium italic">
        {{ $message }}
    </p>
    @enderror
</div>
