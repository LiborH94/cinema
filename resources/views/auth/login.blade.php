<x-layout>
    <x-ui.card title="Přihlaste se">
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
