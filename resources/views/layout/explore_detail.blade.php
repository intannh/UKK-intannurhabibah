<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="{{ asset('css/buildcss.css') }}" rel="stylesheet" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" />
</head>
@stack('cssjsexternal')
<title>i - gallery | explore detail</title>

<body>
    <!--nav-->
    @include('layout.navbar2')
    <!--end nav-->
    <!--section-->
    @yield('content2')
    <!--end section bawah-->
    <script src="/node_modules/flowbite/dist/flowbite.min.js"></script>
</body>
@stack('footerjsexternal')

</html>
