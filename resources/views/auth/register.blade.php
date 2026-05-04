<x-layout>
    <x-ui.card title="Registrujte se">
        <form class="p-6" action="{{route('register')}}" method="POST">
            @csrf
            <x-form.input name="name" label="Jméno"/>
            <x-form.input name="email" label="Email" type="email"/>
            <x-form.input name="password" label="Heslo" type="password"/>
            <x-form.input name="password_confirmation" label="Heslo znovu" type="password" />
            <div class="flex justify-center">
                <x-ui.action-button>Registrovat se</x-ui.action-button>
            </div>
        </form>
    </x-ui.card>
</x-layout>
