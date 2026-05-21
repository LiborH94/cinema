@if (session()->has('status') || session()->has('success') || session()->has('error') || $errors->any())
    @php
        $isError = session()->has('error') || $errors->any();

        $borderColor = $isError ? 'border-red-500/30' : 'border-emerald-500/30';
        $iconBg = $isError ? 'bg-red-500/20' : 'bg-emerald-500/20';
        $iconColor = $isError ? 'text-red-400' : 'text-emerald-400';

        $message = $errors->any() ? $errors->first() : (session('status') ?? session('success') ?? session('error'));
    @endphp

    <div
        x-data="{ show: true }"
        x-init="setTimeout(() => show = false, 4000)"
        x-show="show"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 -translate-y-4"
        x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100 translate-y-0"
        x-transition:leave-end="opacity-0 -translate-y-4"
        class="fixed w-100 top-16 z-50 right-5 bg-slate-800 border-b {{ $borderColor }}
        text-white px-6 py-3"
    >
        <div class="max-w-7xl mx-auto flex items-center justify-between gap-4">

            <div class="flex items-center space-x-3">
                <div class="{{ $iconBg }} {{ $iconColor }} p-2 rounded-lg shrink-0">
                    @if($isError)
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 3.75h.008v.008H12v-.008Z" />
                        </svg>
                    @else
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        </svg>
                    @endif
                </div>

                <p class="text-md text-slate-200 font-medium">
                    {{ $message }}
                </p>
            </div>

            <button
                @click="show = false"
                class="text-slate-500 hover:text-slate-300 transition-colors p-1 rounded-md hover:bg-slate-800 shrink-0 cursor-pointer"
            >
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-4 h-4">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
    </div>
@endif
