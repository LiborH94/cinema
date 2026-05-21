<x-layout>
    <div class="max-w-2xl mx-auto cp-6 mt-10">
        <x-ui.card class="">

            <div class="flex items-center space-x-4 border-b border-slate-800 pb-6 mb-6">
                <div class="bg-gray-300 text-slate-950 p-4 rounded-full shadow-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-8 h-8">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                    </svg>
                </div>
                <div>
                    <h1 class="text-2xl font-bold tracking-tight">Upravit profil</h1>
                    <p class="text-sm text-slate-400">Změňte své kontaktní údaje</p>
                </div>
            </div>

            <form action="{{ route('profile.update', $user) }}" method="POST" class="space-y-6">
                @csrf
                @method('PATCH')

                <x-form.input
                    label="Jméno a příjmení"
                    name="name"
                    :value="$user->name"
                    required
                />

                <x-form.input
                    label="E-mailová adresa"
                    name="email"
                    type="email"
                    :value="$user->email"
                />

                <div class="mt-8 pt-6 border-t border-slate-800 flex gap-4 justify-end items-center">

                    <x-ui.action-button href="{{ route('profile.show', $user) }}" class="text-sm text-slate-400 hover:text-white
                    transition-colors mr-2">
                        Zrušit
                    </x-ui.action-button>

                    <x-ui.action-button
                        type="amber">
                        Uložit změny
                    </x-ui.action-button>
                </div>
            </form>

        </x-ui.card>
    </div>
</x-layout>
