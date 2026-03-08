<!DOCTYPE html>
<html lang="pt-BR" class="overflow-x-hidden">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">

    <title>@yield('title', 'Gestão de Projetos')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://unpkg.com/imask"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100 overflow-x-hidden w-full font-sans antialiased">

    <main class="flex-grow">
        @yield('content')
    </main>

</body>

</html>
