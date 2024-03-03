<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('css/buildcss.css') }}" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Caveat&family=Pacifico&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300&display=swap" rel="stylesheet" />
    <title>i - gallery | sign up</title>
</head>

<body>
    <!--nav-->
    @include('layout.navbar1')
    <!--end nav-->

    <!--section register-->
    @yield('content')
    <!--end section register-->
    <script src="/node_modules/flowbite/dist/flowbite.min.js"></script>
</body>

</html>
