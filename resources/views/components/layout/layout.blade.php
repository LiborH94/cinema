@props(['title' => 'Cinema'])
    <!doctype html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>{{ $title }}</title>
</head>
<body class="bg-slate-950 min-h-screen flex flex-col">

<header>
    <x-layout.nav />
</header>
<main
    class="grow bg-cover bg-center bg-scroll md:bg-fixed text-gray-300"
    style="background-image: url('{{ asset('images/background.png') }}')">
    {{ $slot }}
</main>
<x-ui.flash />
<x-layout.footer />

</body>
</html>
