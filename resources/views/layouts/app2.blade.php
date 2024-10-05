<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <link rel="shortcut icon" href="{{asset('components/asset/logo/512.png')}}" type="image/x-icon">
    <link rel="stylesheet" href="{{asset('components/css/app.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/3.5.0/remixicon.css">
    @stack('css')
</head>
<body>
@yield('content')
</body>
<script src="https://cdn.tailwindcss.com"></script>
@stack('js')
</html>
