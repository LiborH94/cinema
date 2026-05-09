@props(['label', 'name', 'options' => [], 'value' => ''])

<div class="mb-5">
    @if($label)
        <label for="{{ $name }}" class="block text-sm font-semibold mb-2 ml-1 text-slate-400 uppercase tracking-wider">
            {{ $label }}
        </label>
    @endif

    <select
        id="{{ $name }}"
        name="{{ $name }}"
        {{ $attributes->merge([
            'class' => 'bg-slate-950 text-gray-200 w-full px-4 py-3 border border-slate-800 rounded-xl
                       outline-none transition-all duration-200
                       placeholder:text-slate-600
                       focus:border-amber-500/50 focus:ring-1 focus:ring-amber-500/50
                       focus:scale-[1.01] shadow-2xl'
        ]) }}
    >
        <option value="" disabled {{ $value == '' ? 'selected' : '' }}>Vyberte z možností...</option>
        @foreach($options as $id => $label)
            <option value="{{ $id }}" {{ old($name, $value) == $id ? 'selected' : '' }}>
                {{ $label }}
            </option>
        @endforeach
    </select>

    @error($name)
    <p class="text-red-500 text-xs mt-2 ml-1 font-medium italic">{{ $message }}</p>
    @enderror
</div>
