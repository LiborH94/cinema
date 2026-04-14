<x-layout>
    <h2 class="text-3xl text-center p-4 font-bold">Vytvořte si účet</h2>
    <form class="p-6" action="{{route('register')}}" method="POST">
        @csrf
        <x-form.input name="name" label="Jméno"/>
        <x-form.input name="email" label="Email" type="email"/>
        <x-form.input name="password" label="Heslo" type="password"/>
        <x-form.input name="password_confirmation" label="Heslo znovu" type="password" />
        <div class="flex justify-center mt-6">
            <x-form.button>Zaregistrovat se</x-form.button>
        </div>
    </form>
</x-layout>
