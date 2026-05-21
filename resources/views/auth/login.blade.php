<x-layout>
    <x-ui.card title="Přihlaste se">
        @if(\App\Models\User::count() === 0)
            <div class="bg-slate-950/50 flex flex-col justify-center items-center gap-5 p-5 rounded-lg w-200 mx-auto">
                <p>Vítejte v aplikaci Kino! Vypadá to, že databáze je zatím prázdná.</p>
                <p>Kliknutím na tlačítko níže automaticky vytvoříte tabulky, sály, sedadla, filmy a testovací uživatele.</p>

                <form action="{{ route('database.init') }}" method="POST">
                    @csrf
                    <x-ui.action-button type="danger">
                            Naplnit aplikaci daty
                    </x-ui.action-button>
                </form>
            </div>
        @else
            <div class="bg-slate-950/50 flex flex-col justify-center items-center gap-5 p-5 rounded-lg w-200 mx-auto">
                <h3 class="text-amber-500 font-bold">Administrátor</h3>
                <span>
                    admin@cinema.test
                </span>
                <span>
                    admin123
                </span>
            </div>
        @endif
        <form class="p-6" action="{{route('login')}}" method="POST">
            @csrf
            <x-form.input name="email" label="Email" type="email"/>
            <x-form.input name="password" label="Heslo" type="password"/>
            <div class="flex justify-center mt-6">
                <x-ui.action-button>Přihlásit se</x-ui.action-button>
            </div>
        </form>
    </x-ui.card>

</x-layout>
