<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <link rel="shortcut icon" href="{{ asset('components/asset/logo/512.png') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('components/css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('components/css/nav.css') }}">
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/3.5.0/remixicon.css">
    @stack('css')
</head>

<body>
    @include('template.nav')
    @yield('content')
</body>
<script src="https://cdn.tailwindcss.com"></script>
@stack('js')

</html>
