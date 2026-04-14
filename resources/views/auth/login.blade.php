<x-layout>
    <h2 class="text-3xl text-center p-4 font-bold">Přihlaste se</h2>
    <form class="p-6" action="{{route('login')}}" method="POST">
        @csrf
        <x-form.input name="email" label="Email" type="email"/>
        <x-form.input name="password" label="Heslo" type="password"/>
        <div class="flex justify-center mt-6">
            <x-form.button>Přihlásit se</x-form.button>
        </div>
    </form>
</x-layout>
