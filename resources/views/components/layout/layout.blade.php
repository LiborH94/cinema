@props(['title' => 'Cinema'])
<!doctype html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @vite(['resources/css/app.css'])
    <title>{{ $title }}</title>
</head>


<body
    class="bg-slate-950 min-h-screen flex flex-col">
    <header>
        <x-layout.nav />
    </header>
    <main
        class="grow min-h-100 bg-cover bg-center bg-fixed text-gray-300"
        style="background-image: url('{{asset('images/background.png')}}')">
        {{ $slot }}
    </main>
    <x-layout.footer />
</body>
</html>
