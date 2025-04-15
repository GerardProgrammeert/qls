<!doctype html>
<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>@yield('title', 'Webshop Mooiekleding.nl')</title>
</head>
<body>
<main>
    @yield('content')
    @stack('scripts')
</main>
<footer>

</footer>
</body>
</html>
