<x-layout>
    <x-card title="Přihlaste se">
        <form class="p-6" action="{{route('login')}}" method="POST">
            @csrf
            <x-form.input name="email" label="Email" type="email"/>
            <x-form.input name="password" label="Heslo" type="password"/>
            <div class="flex justify-center mt-6">
                <x-form.button>Přihlásit se</x-form.button>
            </div>
        </form>
    </x-card>

</x-layout>
