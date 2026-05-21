<x-layout>
    <div class="max-w-2xl mx-auto cp-6 mt-10">
        <x-ui.card>
            <div class="flex items-center space-x-4 border-b border-slate-800 pb-6 mb-6">
                <div class="bg-gray-300 text-slate-950 p-4 rounded-full shadow-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-8 h-8">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                    </svg>
                </div>
                <div>
                    <h1 class="text-2xl font-bold tracking-tight">Můj profil</h1>
                    <p class="text-sm text-slate-400">Správa vašich osobních údajů v kině</p>
                </div>
            </div>

            <div class="space-y-6">
                <div>
                    <span class="block text-xs font-semibold uppercase tracking-wider text-slate-400 mb-1">Jméno a příjmení</span>
                    <p class="text-lg font-medium text-slate-200">{{ $user->name }}</p>
                </div>

                <div>
                    <span class="block text-xs font-semibold uppercase tracking-wider text-slate-400 mb-1">E-mailová adresa</span>
                    <p class="text-lg font-medium text-slate-200">{{ $user->email }}</p>
                </div>

                <div>
                    <span class="block text-xs font-semibold uppercase tracking-wider text-slate-400 mb-1">Členem od</span>
                    <p class="text-sm text-slate-400">{{ $user->created_at->format('d. m. Y H:i') }}</p>
                </div>
            </div>

            <div class="mt-8 pt-6 border-t border-slate-800 flex justify-end space-x-4">
                <a href="{{ route('profile.edit', $user) }}"
                   class="px-5 py-2.5 bg-amber-500 hover:bg-amber-600 text-slate-950 font-semibold rounded-lg shadow transition-all duration-300 hover:scale-105">
                    Upravit profil
                </a>
            </div>

        </x-ui.card>
    </div>
</x-layout>
