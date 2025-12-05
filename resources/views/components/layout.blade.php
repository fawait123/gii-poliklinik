<!doctype html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="{{ asset('assets/svg/icon.svg') }}">
    <title>{{ config('app.name') }}</title>
    @vite(['resources/css/luvi-ui.css', 'resources/js/app.js'])
</head>

<body x-data="{ page: 'dashboard', 'loaded': true, 'darkMode': false, 'stickyMenu': false, 'sidebarToggle': false, 'scrollTop': false }">
    {{ $slot }}
</body>

</html>
