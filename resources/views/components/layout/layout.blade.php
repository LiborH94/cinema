@props(['title' => 'Cinema'])
<!doctype html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @vite(['resources/css/app.css'])
    <title>{{ $title }}</title>
</head>
<body class="bg-gray-200">
    <x-layout.nav />
    {{ $slot }}
</body>
</html>
