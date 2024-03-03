<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('css/build.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Caveat&family=Pacifico&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300&display=swap" rel="stylesheet" />
</head>
<title>i - gallery | edit password</title>
<style>
    @media(max-width:768px) {
        .flex-container {
            flex-direction: column;
        }

        .fulwidth {
            width: 100%;
        }

        .fulheight {
            height: 100%;
        }
    }
</style>

<body>
    <!--nav-->
    @include('layout.navbar2')
    <!--end nav-->

    <!--section-->
    @yield('content2')
    <!--end section-->
    <script src="/node_modules/flowbite/dist/flowbite.min.js"></script>
</body>

</html>
